<?php

namespace App\Http\Controllers\User;
use  App\Http\Controllers\Controller;

use App\Models\Poll_unit;
use App\Services\States;
use Illuminate\Http\Request;

class PollUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(States $allstate)
    {
       
        return view('polling_unit.index',['states'=>$allstate->all()]);
       
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
     * @param  \App\Models\Poll_unit  $poll_unit
     * @return \Illuminate\Http\Response
     */
    public function show($ward_id)
    {
        $ward = Poll_unit::where('ward_id', $ward_id)->get();
        return response()->json($ward);
    }

    public function pollid($poll_id,$ward_id)
    {
        $result = Poll_unit::where(
                [
                ['polling_unit_id', $poll_id],
                ['ward_id', $ward_id],
            
                
                ])->select('uniqueid')->first();
        return response()->json($result);
    }
    public function showAllpollId($lga_id){

        $poll_id = Poll_unit::where('lga_id', $lga_id)->select('polling_unit_id')->get();
        return response()->json($poll_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poll_unit  $poll_unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll_unit $poll_unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poll_unit  $poll_unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll_unit $poll_unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll_unit  $poll_unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll_unit $poll_unit)
    {
        //
    }
}
