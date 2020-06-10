<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Contrato;
use App\User;
use App\Http\Requests\PagoFormRequest;
use Illuminate\Http\Request;

class ContratoPagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($contrato_id, Request $request)
    {
        $palabrasbuscar = explode(" ",$request->post('buscar'));
        $pagos = Pago::orderBy('nrecibo', 'ASC')
                    ->select('pago.*')
                    ->join('contrato','contrato_id','=','contrato.id')
                    ->where('contrato_id', '=', $contrato_id);
        $AbonoTotal = Pago::orderBy('nrecibo', 'ASC')
                    ->select('pago.*')
                    ->join('contrato','contrato_id','=','contrato.id')
                    ->where('contrato_id', '=', $contrato_id)
                    ->sum('abono');
        $ValContrato = Contrato::select('valor')->findOrFail($contrato_id);

        $Saldo = $ValContrato->valor - $AbonoTotal;

        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){
            $columnas = ['nrecibo', 'fecha', 'abono'];
            $Pagos = $pagos->whereOrSearch($palabrasbuscar, $columnas);
            return view('contrato.pago.index', compact('contrato_id', 'Pagos', 'Saldo'))
                    ->with('success',['Busqueda realizada']);
        }else{
            $Pagos = $pagos->paginate(10);
            return view('contrato.pago.index', compact('contrato_id', 'Pagos', 'Saldo'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($contrato_id)
    {
        return view('contrato.pago.create', compact('contrato_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($contrato_id, PagoFormRequest $request)
    {
        $d = $request->except('_token');
        $pago = Pago::create($d);
        return redirect()->route('contrato.pago.index', $contrato_id)
                ->with('success',['Pago del contrato almacenado completamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show($contrato_id, $id)
    {
        $pago = Pago::findOrFail($id);
        $auditoria = User::findOrFail($pago->users_id);
        return view('contrato.pago.show', compact('contrato_id', 'auditoria', 'pago'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit($contrato_id, $id)
    {
        $pago = Pago::findOrFail($id);
        return view('contrato.pago.edit', compact('pago', 'contrato_id', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update($contrato_id, $id, PagoFormRequest $request)
    {
        $pago = Pago::findOrFail($id);
        $pago->update($request->except('_token'));
        return redirect()->route('contrato.pago.index', $contrato_id)
                    ->with('success',['Recordatorio del proceso actualizado completamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy($contrato_id, $id)
    {
        $pago = Pago::findOrFail($id);
        if($pago->delete())
            return redirect()->route('contrato.pago.index', $contrato_id)->with('success',['Registro borrado completamente']);
        return redirect()->route('contrato.pago.index', $contrato_id)->withErrors(['No se pudo borrar el registro']);
    }
}
