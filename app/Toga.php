<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toga extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mahasiswa_id','size_toga','no_wa', 'asal_daerah', 'nama_ayah', 'nama_ibu', 'pendamping'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa');
    }

}
