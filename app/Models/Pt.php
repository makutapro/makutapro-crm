<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pt extends Model
{
    use HasFactory;
    protected $table = 'pt';
    protected $fillable = [
        'user_id',
        'kode_pt',
        'nama_pt',
        'pic',
        'logo',
        'inc_book',
    ];

    /**
     * Get the user that owns the Pt
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all of the comments for the Pt
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function project()
    {
        return $this->hasMany(Project::class, 'pt_id');
    }

}
