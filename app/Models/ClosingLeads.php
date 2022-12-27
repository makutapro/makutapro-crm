<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosingLeads extends Model
{
    use HasFactory;
    protected $table = 'leads_closing';
    protected $fillable = [
        'prospect_id',
        'agent_id',
        'sales_id',
        'unit_id',
        'ket_unit',
        'closing_amoount',
    ];
}
