<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $dates = ['created_at'];
    protected $fillable = [
        'kategori',
        'name',
        'alamat',
        'aspirasi',
        'keterangan',
        'gambar_kejadian',
        'status'
    ];
}
