<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keringanan extends Model
{
    protected $fillable = [
        'file_keringanan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa');
    }
}
