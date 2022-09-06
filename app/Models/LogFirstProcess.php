<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogFirstProcess extends Model
{
    use HasFactory;
    protected $table = 'log_first_process';
    protected $fillable = ['sales_id','prospect_id','accept_at'];
    public $timestamps = false;
}
