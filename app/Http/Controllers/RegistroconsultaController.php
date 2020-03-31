<?php

namespace App\Http\Controllers;

use App\Models\Registroconsulta;
use App\User;
use Illuminate\Http\Request;

class RegistroconsultaController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registroconsulta  $registroconsulta
     * @return \Illuminate\Http\Response
     */
    public function show(Registroconsulta $registroconsulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registroconsulta  $registroconsulta
     * @return \Illuminate\Http\Response
     */
    public function edit(Registroconsulta $registroconsulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registroconsulta  $registroconsulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registroconsulta $registroconsulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registroconsulta  $registroconsulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registroconsulta $registroconsulta)
    {
        //
    }
}
