<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $table = 'agent';
    protected $fillable = ['user_id','project_id','kode_agent','nama_agent','urut_agent','pic','hp','email'];
}
