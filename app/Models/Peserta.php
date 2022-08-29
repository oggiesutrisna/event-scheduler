<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $fillable = [
        'nama',
        'ttl',
        'alamat',
        'instansi',
    ],
    protected $hidden = [
        'password',
    ],
    use HasFactory;
}
