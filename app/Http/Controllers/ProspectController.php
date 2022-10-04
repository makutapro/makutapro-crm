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
        $query = HistoryProspect::all_leads() ->where('prospect.nama_prospect','like','%'.$request->search['value'].'%');
        if($request->project != ""){
            $query = $query->where('history_prospect.project_id','=',$request->project);
        }
        if($request->since != ""){
            $query = $query->where('prospect.created_at','>=',$request->since);
        }
        if($request->to != ""){
            $query = $query->where('prospect.created_at','<=',$request->to);
        }
        
        $field = [
            'prospect.id',
            'prospect.nama_prospect',
            'sumber_data.nama_sumber'
            // 'sumber_platform_id',
            // 'campaign_id',
            // 'project_id',
            ];
        $query = $query->orderBy($field[$request->order[0]['column']],$request->order[0]['dir']);
        // if($request->status != ""){
        //     $query = $query->where();
        // }
        // if($request->status != ""){
        //     $query = $query->where();
        // }
        
        $data = [
            'draw' => $request->draw,
            // 'recordsTotal' => HistoryProspect::total_leads()->count(),
            // nampilin count data
            'recordsFiltered' => $query->count(),
            // nampilin semua data 
            'data' => $query->skip($request->start)->take($request->length)->get()
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