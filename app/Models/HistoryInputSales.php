<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryInputSales extends Model
{
    use HasFactory;
    protected $table = 'history_input_sales';
    protected $fillable = [
        'prospect_id',
        'pt_id',
        'project_id',
        'agent_id',
        'sales_id',
    ];
    // public $timestamps = false;
}
