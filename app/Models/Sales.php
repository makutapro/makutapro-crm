<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = ['user_id','agent_id','kode_sales','nama_sales','urut_kode_sales','urut_agent_sales','hp','email','ktp','token_fcm','device_id'];
}
