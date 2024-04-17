<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'note',
        'comment',
        'teacher_id',
        'project_id'
    ];
}
