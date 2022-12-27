<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function get_campaign(Request $request)
    {
        $campaign = Campaign::where(['project_id' => $request->project])->pluck(
            'nama_campaign',
            'id'
        );

        return response()->json($campaign);
    }
}
