<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceLine extends Model
{
    use SoftDeletes;

    public function invoice() 
    {
        return $this->belongsTo(Invoice::class);
    }
}
