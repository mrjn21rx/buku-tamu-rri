<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_registrasi',
        'nama_lengkap',
        'alamat',
        'no_hp',
        'email',
        'keperluan',
        'divisi_tujuan',
        'tanggal_kunjungan',
        'jam_kunjungan', 
        'temu_janji',    
        'status',
    ];
}