<?php

namespace App\Http\Controllers;

use App\Personajuridica;
use App\User;
use Illuminate\Http\Request;

class PersonajuridicaController extends Controller
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
     * @param  \App\Personajuridica  $personajuridica
     * @return \Illuminate\Http\Response
     */
    public function show(Personajuridica $personajuridica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personajuridica  $personajuridica
     * @return \Illuminate\Http\Response
     */
    public function edit(Personajuridica $personajuridica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personajuridica  $personajuridica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personajuridica $personajuridica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personajuridica  $personajuridica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personajuridica $personajuridica)
    {
        //
    }
}
