<?php

namespace App\Http\Controllers;

use App\Actuacionproceso;
use App\User;
use Illuminate\Http\Request;

class ActuacionprocesoController extends Controller
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
     * @param  \App\Actuacionproceso  $actuacionproceso
     * @return \Illuminate\Http\Response
     */
    public function show(Actuacionproceso $actuacionproceso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actuacionproceso  $actuacionproceso
     * @return \Illuminate\Http\Response
     */
    public function edit(Actuacionproceso $actuacionproceso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actuacionproceso  $actuacionproceso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actuacionproceso $actuacionproceso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actuacionproceso  $actuacionproceso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actuacionproceso $actuacionproceso)
    {
        //
    }
}
