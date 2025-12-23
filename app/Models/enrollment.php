<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'school_class_id',
        'subject_id',
        'semester',
        'year',
    ];

    // Ангиар холбох relation
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    // Хичээлтэй холбох relation
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
