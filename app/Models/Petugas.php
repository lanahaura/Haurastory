<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    protected $table = 'petugas';

    protected $fillable = ['name', 'username', 'password'];

    protected $hidden = ['password'];
}
