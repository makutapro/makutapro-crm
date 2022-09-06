<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryProspectMove extends Model
{
    use HasFactory;
    protected $table = 'history_prospect_move';
    protected $fillable = [
        'prospect_id',
        'project_id',
        'agent_id',
        'move_agent_id',
        'agent_id_prev',
        'move_agent_id_prev',
        'sales_id',
        'move_sales_id',
        'sales_id_prev',
        'move_sales_id_prev'
    ];
}
