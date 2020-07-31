<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persembahan extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_tim','nama_pj','npm_pj', 'line_pj', 'jenis_persembahan', 'jumlah_personil','link_youtube',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa');
    }
}
