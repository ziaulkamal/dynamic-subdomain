<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;
    protected $table = 'queries'; // Sesuaikan dengan nama tabel yang Anda gunakan untuk menyimpan query

    protected $fillable = [
        'query',
    ];
}
