<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAgent extends Model
{
    use HasFactory;
    protected $table = 'project_agent';
    protected $fillable = ['project_id','agent_id','urut_project_agent'];
    public $timestamps = false;
}
