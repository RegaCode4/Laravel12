<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    // protected $table = 'pegawai';
    // protected $connection = 'postgres';
    use HasFactory;
    //boleh diisi dengan field apa saja yang tidak boleh diisi, misalnya id, created_at, updated_at
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function bagian()
    {
        return $this->belongsTo(Bagian::class);
    }
}
