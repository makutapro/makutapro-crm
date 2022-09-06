<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsNotInterested extends Model
{
    use HasFactory;
    protected $table = 'leads_not_interested';
    protected $fillable = [
        'prospect_id',
        'sales_id',
        'not_interested_id'
    ];
    // public $timestamps = false;
}
