<?php

namespace App\Http\Controllers\User;
use  App\Http\Controllers\Controller;

use App\Models\Lga;
use App\Services\States;
use Illuminate\Http\Request;

class LgaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(States $allstate)
    {
        return view('lga_result.index',['states'=>$allstate->all()]);
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
     * @param  \App\Models\Lga  $lga
     * @return \Illuminate\Http\Response
     */
    public function show($stateId)
    {
        $lgas = LGA::where('state_id', $stateId)->get();
        return response()->json($lgas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lga  $lga
     * @return \Illuminate\Http\Response
     */
    public function edit(Lga $lga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lga  $lga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lga $lga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lga  $lga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lga $lga)
    {
        //
    }
}
