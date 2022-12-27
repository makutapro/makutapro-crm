<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryChangeStatus extends Model
{
    use HasFactory;
    protected $table = 'history_change_status';
    protected $fillable = [
        'user_id',
        'prospect_id',
        'status_id',
        'standard_id',
        'note_standard',
        'chat_file',
        'role_id',
    ];
    public $timestamps = ["created_at"];
    const UPDATED_AT = NULL;
}
