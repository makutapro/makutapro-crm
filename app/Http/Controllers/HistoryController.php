<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryChangeStatus;

class HistoryController extends Controller
{
    public function history(Request $request){
        $historyCs = HistoryChangeStatus::join('status','status.id','history_change_status.status_id')
                    ->join('users','users.id','history_change_status.user_id')
                    ->join('standard','standard.id','history_change_status.standard_id')
                    ->where('history_change_status.prospect_id',$request->prospect_id)
                    ->select(
                        'status.id',
                        'status.status',
                        'users.name',
                        'standard.alasan',
                        'history_change_status.created_at',
                        'history_change_status.chat_file',
                        'history_change_status.standard_id'
                    )
                    ->get();

        return response()->json($historyCs);
    }
}
