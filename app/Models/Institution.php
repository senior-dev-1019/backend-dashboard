<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use SoftDeletes;

    public function users() 
    {
        return $this->hasMany(User::class);
    }

    public function patients() 
    {
        return $this->hasMany(User::class);
    }

}
