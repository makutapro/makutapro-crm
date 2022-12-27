<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\User;
use App\Models\HistoryProspect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($agent_id)
    {
        // ==============>> SCRIPT 1 USER FOR MULTIPLE SALES ACCOUNT <<==============
        // $data = Sales::all();
        // // dd($data);
        // for ($i=0; $i < count($data); $i++) { 
        //     $usr = User::where('hp',$data[$i]->hp)->get();
        //     // dd($usr);
        //     if(count($usr)>1){ //jika sudah ada user
        //         for ($j=0; $j < count($usr); $j++) { 
        //             # code...
        //             if($usr[$j]->role == 6){ //cek apakah belum ada user dengan role sales
        //                 // dd('if');
        //                 User::where('id',$data[$i]->user_id)->update([
        //                     'hp' => $data[$i]->hp,
        //                     'email' => $data[$i]->email,
        //                 ]);
        //             }
        //         }
        //     }else{
        //         // dd('else');
        //         $temp = User::find($data[$i]->user_id);
        //         // dd($temp);
        //         if($temp->hp == null){
        //             // dd('if');
        //             User::where('id',$data[$i]->user_id)->update([
        //                 'hp' => $data[$i]->hp,
        //                 'email' => $data[$i]->email,
        //             ]);
        //         }
                
        //     }
        // } die;
         // ==============>> END OF SCRIPT 1 USER FOR MULTIPLE SALES ACCOUNT <<==============
        
        $data = Sales::join('users','users.id','sales.user_id')
                        ->where('agent_id',$agent_id)
                        ->select('sales.id','sales.kode_sales','sales.nama_sales','sales.urut_agent_sales','sales.created_at','users.hp','users.email','users.photo','users.ktp')
                        ->get();

        for ($i=0; $i < count($data); $i++) { 
            $closingAmount = Sales::join('leads_closing','leads_closing.sales_id','sales.id')
                                ->select(DB::raw('sum(leads_closing.closing_amount) as closing_amount'))
                                ->where('leads_closing.sales_id',$data[$i]->id)
                                ->get();
            
            $prospect = HistoryProspect::where('sales_id',$data[$i]->id)
                                        ->select(DB::raw('count(id) as total_prospect'))
                                        ->get();

            $data[$i]->closing_amount = $closingAmount[0]->closing_amount;
            $data[$i]->total_prospect = $prospect[0]->total_prospect;
        }
        return view('pages.sales.index',compact('data'));
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
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales)
    {
        //
    }
}
