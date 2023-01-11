<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\ProjectAgent;
use App\Models\Sales;
use App\Models\User;
use App\Models\Fu;
use App\Models\HistoryChangeStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $fu = Fu::all();
        // for ($i=0; $i < count($fu); $i++) { 
        //     $agent = Agent::where('kode_agent',$fu[$i]->KodeAgent)->get();
        //     $sales = Sales::where('kode_sales',$fu[$i]->KodeSales)->get();
        //     $data = Fu::find($fu[$i]->id);
        //     Fu::where('id',$fu[$i]->id)->update([
        //         'agent_id' => $agent[0]->id,
        //         'sales_id' => $sales[0]->id,
        //     ]);
        //     // $data->agent_id = $agent->id;
        //     // $data->sales_id = $sales->id;
        //     // $data->save();
        // }die;
        // $agent = Agent::all();
        
        // for ($i=0; $i < count($agent); $i++) { 
        //     User::where('id',$agent[$i]->user_id)->update([
        //         'hp' => $agent[$i]->hp,
        //         'email' => $agent[$i]->email,
        //     ]);
        // }die;


        $data = Agent::agent()->get();
        // dd($data);

        for ($i=0; $i < count($data); $i++) { 
            $closingAmount = Agent::agent()   
                                ->join('leads_closing','leads_closing.agent_id','agent.id')
                                ->select(DB::raw('sum(leads_closing.closing_amount) as closing_amount'))
                                ->where('leads_closing.agent_id',$data[$i]->id)
                                ->get();

            $data[$i]->closing_amount = $closingAmount[0]->closing_amount;
        }
        // dd($data);

        return view('pages.agent.index', compact('data'));
    }

    public function active(Request $request){
        // ambil data agent yang ingin di aktifkan
        $agent = Agent::find($request->agent_id);
        
        $UrutAgentMax = Agent::where(['project_id' => $agent->project_id])->max('urut_agent');

        $agent->urut_agent = $UrutAgentMax+1;
        $agent->save();

        ProjectAgent::where(['agent_id' => $agent->id])->update([
            'urut_project_agent' => $UrutAgentMax+1
        ]);

        User::where(['id' => $agent->user_id])->update([
            'active' => 1,
        ]);

        return redirect()
            ->back()
            ->with('status', 'Agent telah di aktifkan!');
    }

    public function nonactive(Request $request){
        // ambil data agent yang ingin di non aktifkan
        $agent = Agent::find($request->agent_id);
        
        // ambil data agent yang no urutnya lebih besar dari agent yg ingin di non aktifkan
        $data = Agent::where('project_id', $agent->project_id)
                        ->where('urut_agent','>',$agent->urut_agent)
                        ->get();


        // update data agent (urut agent) yang no urut nya lebih besar dari agent yg ingin di non aktifkan
        if (count($data) > 0) {
            if($data[0]->urut_agent != $agent->urut_agent + 1){
                return redirect()
                        ->back()
                        ->with('status', 'Ada kesalahan saat menonaktifkan agent');
            }
            for ($i = 0; $i < count($data); $i++) {
                Agent::where(['id' => $data[$i]->id])->update([
                    'urut_agent' => $data[$i]->urut_agent - 1,
                ]);
            }
        }
        
        $agent->urut_agent = 0;
        $agent->active = 0;
        $agent->save();

        ProjectAgent::where(['agent_id' => $agent->id])->update([
            'urut_project_agent' => 0
        ]);

        User::where(['id' => $agent->user_id])->update([
            'active' => 0,
        ]);

        
        return redirect()
            ->back()
            ->with('status', 'Agent telah di non-aktifkan!');
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
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        //
    }

    public function get_agent(Request $request)
    {
        $agent = Agent::where(['project_id' => $request->project,'active' => 1])->pluck(
            'nama_agent',
            'id'
        );

        return response()->json($agent);
    }

    public function getsales(Request $request)
    {
        $sales = Sales::where(['sales.agent_id' => $request->agent, 'active' => 1])
                        ->pluck('nama_sales','id');

        return response()->json($sales);
    }
}