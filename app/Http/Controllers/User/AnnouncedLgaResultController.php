<?php

namespace App\Http\Controllers\User;
use  App\Http\Controllers\Controller;

use App\Models\Announced_lga_result;
use Illuminate\Http\Request;

class AnnouncedLgaResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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
     * @param  \App\Models\Announced_lga_result  $announced_lga_result
     * @return \Illuminate\Http\Response
     */
    public function show($lga_id)
    {
        
        $lgas = Announced_lga_result::where('lga_name', $lga_id)->get();
        return response()->json($lgas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announced_lga_result  $announced_lga_result
     * @return \Illuminate\Http\Response
     */
    public function edit(Announced_lga_result $announced_lga_result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announced_lga_result  $announced_lga_result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announced_lga_result $announced_lga_result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announced_lga_result  $announced_lga_result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announced_lga_result $announced_lga_result)
    {
        //
    }
}
