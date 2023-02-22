<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $unittype = DB::table('unit')
        ->join('project', 'project.id','unit.project_id')
        ->join('pt','pt.id','project.pt_id')
        ->select('unit.*', 'project.nama_project')
        ->where('pt.user_id',Auth::user()->id)
        ->orderBy('unit.id', 'desc')
        ->paginate();

        $unitupdate = DB::table('unit')
        ->join('project', 'project.id','unit.project_id')
        ->join('pt','pt.id','project.pt_id')
        ->select('unit.*', 'project.nama_project')
        ->where('pt.user_id',Auth::user()->id)
        ->orderBy('unit.id', 'desc')
        ->paginate(1);
        
        $projects = DB::table('project')
        ->join('pt','pt.id','project.pt_id')
        ->select('project.id', 'project.nama_project')
        ->where('pt.user_id',Auth::user()->id)
        ->get();

        // dd($projects);

        return view('pages.unittype.index', compact('unittype', 'projects')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unittype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unittype       = $request->all();

        Unit::create($unittype);

        // return redirect()->back()->with('status','Data berhasil diinput');

        if($unittype){
            return redirect()->back()->with('status','Data berhasil diinput');

        }else{
            return redirect()->back()->with('status','Data gagal diinput');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unittype)
    {
        return view('unittype.edit', compact('unittype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $unittype = Unit::findorfail($id);

        $unittype->id   = $id;

        $unittype->project_id   = $request->project_id;
        $unittype->unit_name    = $request->unit_name;
        $unittype->unit_class   = $request->unit_class;
        // $unittype->active       = $request->active;

        $unittype->update();


        if($unittype){
            return redirect()->back()->with('status','Data berhasil diupdate');

        }else{
            return redirect()->back()->with('status','Data gagal diupdate');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    
    {

        $unittype = Unit::findorfail($id);
        $unittype->delete();


        if($unittype){
            return redirect()->route('unittype.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            return redirect()->route('unittype.index')->with(['error' => 'Data gagal Dihapus!']);
        }


    }
}
