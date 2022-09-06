<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;
    protected $table = 'prospect';
    protected $fillable = [
        'nama_prospect',
        'kode_negara',
        'hp',
        'email',
        'message',
        'catatan',
        'catatan_sales',
        'verified_status',
        'verified_at',
        'accept_status',
        'accept_at',
        'gender_id',
        'status',
        'usia_id',
        'city_id',
        'pekerjaan_id',
        'penghasilan_id',
        'sumber_data_id',
        'note_sumber_data',
        'sumber_platform_id',
        'sumber_ads_id',
        'campaign_id',
        'not_interested_id',
        'not_interested_at',
        'role_by',
        'input_by',
        'edit_by',
        'tertarik_tipe_unit_id',
    ];
}
