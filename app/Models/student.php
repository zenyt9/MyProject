<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',  // нэр
        'lastname',   // овог
        'birthday',   // төрсөн огноо
        'gender',     // хүйс
        'angi_id',    // ангийн ID
        'phone',      // утас
        'email',      // и-мэйл
        'image'       // зураг
    ];

    // Анги relation
    public function angi()
    {
        return $this->belongsTo(SchoolClass::class, 'angi_id');
    }
}
