<?php

namespace App\Http\Controllers;
use App\Models\Standard;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function getstandard(Request $request){
        $reason = Standard::where('status_id',$request->status_id)->pluck('alasan','id');
        return response()->json($reason);
    }
}
