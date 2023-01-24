<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemindStatus extends Model
{
    use HasFactory;
    protected $table = 'remind_status';
    protected $fillable = [
        'sales_id',
        'prospect_id',
        'ColdDay2',
        'ColdDay3',
        'WarmDay5',
        'WarmDay10',
        'WarmDay15',
        'WarmDay19',
        'HotDay5',
        'HotDay10',
        'HotDay15',
        'HotDay19',
    ];
}
