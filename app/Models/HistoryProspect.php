<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryProspect extends Model
{
    use HasFactory;
    protected $table = 'history_prospect';
    protected $fillable = ['prospect_id','pt_id','project_id','agent_id','sales_id','blast_agent_id','blast_sales_id','move_id','number_move','move_date','assign_date'];
    // public $timestamps = false;

    public static function total_leads(){
        return DB::table('history_prospect')
                    ->join('prospect','prospect.id','history_prospect.prospect_id')
                    ->join('pt','pt.id','history_prospect.pt_id')
                    ->join('users','users.id','pt.user_id')
                    ->where('users.id',Auth::user()->id);
                    // ->get();
    }

}
