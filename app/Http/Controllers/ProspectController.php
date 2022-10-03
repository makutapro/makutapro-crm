<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use App\Models\Project;
use App\Models\HistoryProspect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = HistoryProspect::total_leads()->get();
        $project = Project::get_project()->select('project.*')->get();
        $platform = DB::table('sumber_platform')->get();
        $source = DB::table('sumber_data')->get();
        $status = DB::table('status')->get();
        
        return view('pages.prospect.index',compact('project','platform','source','status'));
    }

    public function get_all(Request $request){
        // return($request->search);
        $data = [
            'draw' => $request->draw,
            // 'recordsTotal' => HistoryProspect::total_leads()->count(),
            'recordsFiltered' => HistoryProspect::all_leads()
                                ->where('prospect.nama_prospect','like','%'.$request->search['value'].'%')
                                ->count(),
            'data' => HistoryProspect::all_leads()
                    ->where('prospect.nama_prospect','like','%'.$request->search['value'].'%')
                    ->skip($request->start)->take($request->length)->get()
        ];
        // $data = HistoryProspect::total_leads()->get();
        return response()->json($data);
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
     * @param  \App\Models\Prospect  $prospect
     * @return \Illuminate\Http\Response
     */
    public function show(Prospect $prospect)
    {
        
        $data = HistoryProspect::total_leads()->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prospect  $prospect
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospect $prospect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prospect  $prospect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prospect $prospect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prospect  $prospect
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prospect $prospect)
    {
        //
    }
}