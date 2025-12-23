<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSelection extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'semester',
        'year',
        // бусад шаардлагатай талбарууд
    ];

    // Оюутантай холбох relation
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Хичээлтэй холбох relation
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
