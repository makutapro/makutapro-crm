<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorySales extends Model
{
    use HasFactory;
    protected $table = 'history_sales';
    protected $fillable = [
        'project_id',
        'sales_id',
        'notes',
        'subject',
        'notes_dev',
        'subject_dev',
        'history_by',
    ];
    // public $timestamps = false;
}
