<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'users';
    protected $fillable = ['name','email','password'];
}
