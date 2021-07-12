<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function invoiceLines()
    {
        return $this->hasMany(InvoiceLine::class);
    }
}
