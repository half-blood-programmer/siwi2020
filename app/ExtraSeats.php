<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraSeats extends Model
{
    //
    protected $fillable = [
        'mahasiswa_id','order_id','jatah_xs','jumlah_xs','type', 'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa');
    }
}
