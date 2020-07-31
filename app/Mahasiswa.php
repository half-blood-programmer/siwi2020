<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nrp','nama','kelas', 'absen', 'prodi_id', 'jenis_kelamin','status_registrasi', 'status_ambil_toga'
    ];

    public function toga()
    {
        return $this->hasOne('App\Toga');
    }

    public function alamat()
    {
        return $this->hasOne('App\Alamat');
    }

    public function prodi()
    {
        return $this->belongsTo('App\Prodi');
    }

    public function persembahan()
    {
        return $this->hasOne('App\Persembahan');
    }

    public function downpayment()
    {
        return $this->hasMany('App\DownPayment');
    }

    public function extraseats()
    {
        return $this->hasMany('App\ExtraSeats');
    }

    public function keringanan()
    {
        return $this->hasOne('App\Keringanan');
    }

    public function pelunasan()
    {
        return $this->hasMany('App\Pelunasan');
    }

    public function refund()
    {
        return $this->hasOne('App\Refund');
    }

}
