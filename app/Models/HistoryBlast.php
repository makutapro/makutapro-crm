<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryBlast extends Model
{
    use HasFactory;
    protected $table = 'history_blast';
    protected $fillable = ['prospect_id','project_id','agent_id','sales_id','blast_agent_id','blast_sales_id'];
    // public $timestamps = false;
    
}
