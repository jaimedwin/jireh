<?php

namespace App\Http\Controllers;

use App\Personanatural;
use App\User;
use Illuminate\Http\Request;

class PersonanaturalController extends Controller
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
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function show(Personanatural $personanatural)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function edit(Personanatural $personanatural)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personanatural $personanatural)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personanatural $personanatural)
    {
        //
    }
}
