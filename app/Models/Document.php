<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;
    
	protected $with = ['patient', 'coupon', 'folder'];
	protected $table = 'documents';

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }
}
