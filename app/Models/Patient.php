<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    
	protected $with = ['institution'];
	protected $table = 'patients';

    public function institution() 
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function users() 
    {
        return $this->belongsToMany(User::class, 'user_patient');
    }

    public function timelineItems()
    {
        return $this->hasMany(TimelineItem::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
