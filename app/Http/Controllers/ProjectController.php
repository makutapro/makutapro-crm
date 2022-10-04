<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Pt;
use App\Models\HistoryProspect;
use Illuminate\Http\Request;
use App\Http\Traits\GlobalTrait;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    use GlobalTrait;

    private $pt;
 
    public function __construct()
    {
        $this->pt = $this->pt();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pt::with('project')
                ->where('user_id',Auth::user()->id)
                ->get();
                
        if(count($data) > 0){
            for ($i=0; $i < count($data[0]->project) ; $i++) { 
                $data[0]->project[$i]->new = HistoryProspect::total_leads()
                                    ->where('prospect.status_id',1)
                                    ->where('history_prospect.project_id','=',$data[0]->project[$i]->id)
                                    ->count();
    
                $data[0]->project[$i]->process = HistoryProspect::total_leads()
                                    ->whereBetween('prospect.status_id',[2,3,4])
                                    ->where('history_prospect.project_id','=',$data[0]->project[$i]->id)
                                    ->count();
    
                $data[0]->project[$i]->notinterested = HistoryProspect::total_leads()
                                    ->where('prospect.status_id',6)
                                    ->where('history_prospect.project_id','=',$data[0]->project[$i]->id)
                                    ->count();
    
                $data[0]->project[$i]->closing = HistoryProspect::total_leads()
                                    ->where('prospect.status_id',5)
                                    ->where('history_prospect.project_id','=',$data[0]->project[$i]->id)
                                    ->count();
            }

            $data = $data[0]->project;
        }
        // dd($data);
        return view('pages.project.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Pt::with('project')
                ->where('user_id',Auth::user()->id)
                ->get();

        Project::create([
            'pt_id' => $data[0]->id,
            'nama_project' => $request->nama_project,
            'description' => $request->description,
            'send_by' => $request->send_by
        ]);

        return redirect('/project')->with('status','Success !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
     public function show(Project $project)
    {
        
        return view('pages.project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->nama_project = $request->nama_project;
        $project->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    public function get_prospect(Request $request){
         // return($request->search);
         $data = [
            'draw' => $request->draw,
            // 'recordsTotal' => HistoryProspect::total_leads()->count(),
            'recordsFiltered' => HistoryProspect::all_leads()
                                ->where('prospect.nama_prospect','like','%'.$request->search['value'].'%')
                                // ->where('history_prospect.project_id',$request->project)
                                ->count(),
            'data' => HistoryProspect::all_leads()
                    ->where('prospect.nama_prospect','like','%'.$request->search['value'].'%')
                    // ->where('history_prospect.project_id',$request->project)
                    ->skip($request->start)->take($request->length)->get()
        ];
        // $data = HistoryProspect::total_leads()->get();
        return response()->json($data);
    }
}