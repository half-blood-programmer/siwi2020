<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mahasiswa_id','alamat','kelurahan', 'kodepos',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa');
    }
}
