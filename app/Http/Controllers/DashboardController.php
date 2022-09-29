<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prospect;
use App\Models\User;
use App\Models\Agent;
use App\Models\ProjectAgent;
use App\Models\Project;
use App\Models\Sales;
use App\Models\HistoryProspect;
use App\Models\HistoryBlast;
use App\Models\HistoryProspectMove;
use App\Models\HistoryInputSales;
use App\Models\HistorySales;
use App\Models\LogFirstProcess;
use App\Models\LeadsClosing;
use App\Models\LeadsNotInterested;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $total = HistoryProspect::total_leads()->count();
        $process = HistoryProspect::total_leads()
                ->whereBetween('prospect.status_id',[2, 4])
                ->count();
        $closing = HistoryProspect::total_leads()
                ->where('prospect.status_id',5)
                ->count();
        $notinterest = HistoryProspect::total_leads()
                ->where('prospect.status_id',6)
                ->count();
        // dd($closing,$notinterest);

        return view('pages.dashboard.index',compact(
            'total','process','closing','notinterest'
        ));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}