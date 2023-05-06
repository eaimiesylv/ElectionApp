<?php

namespace App\Http\Controllers\User;
use  App\Http\Controllers\Controller;

use App\Models\Announced_poll_unit_result;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnnouncedPollUnitResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Announced_poll_unit_result::all();
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
        $data = $request->except('_token');
       
        try {
            $data = $request->except('_token');
    
            foreach ($data as $partyname => $score) {
                $result = new Announced_poll_unit_result;
                $result->polling_unit_uniqueid = time();
                $result->party_abbreviation = $partyname;
                $result->party_score = $score;
                $result->entered_by_user = 'emmanuel';
                $result->user_ip_address = $request->ip();
                $result->date_entered = Carbon::parse(now())->format('Y-m-d H:i:s');
                $result->save();
            }
            
            return redirect()->back()->with('success', 'Data has been inserted successfully.');
        } catch (QueryException $exception) {
            return redirect()->back()->with('error', 'An error occurred while inserting data: ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announced_poll_unit_result  $announced_poll_unit_result
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result= Announced_poll_unit_result::where('polling_unit_uniqueid', $id)->get();
        return response()->json($result);
    }
    public function lgaresult($lga_id)
    {
       
        $result= Announced_poll_unit_result::where('polling_unit_uniqueid', $lga_id)->get();
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announced_poll_unit_result  $announced_poll_unit_result
     * @return \Illuminate\Http\Response
     */
    public function edit(Announced_poll_unit_result $announced_poll_unit_result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announced_poll_unit_result  $announced_poll_unit_result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announced_poll_unit_result $announced_poll_unit_result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announced_poll_unit_result  $announced_poll_unit_result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announced_poll_unit_result $announced_poll_unit_result)
    {
        //
    }
}
