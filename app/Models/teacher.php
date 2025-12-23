<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // fillable гэдэг нь mass assignment-д ашиглагдах талбарууд
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
}
