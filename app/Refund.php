<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mahasiswa_id','nama_bank','nomor_rekening','atas_nama'
    ];

    // protected $fillable = [
    //     'merchantOrderId','paymentMethod', 'status',
    // ];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa');
    }
}
