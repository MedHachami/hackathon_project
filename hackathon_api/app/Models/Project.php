<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "link",
        "user_id",
        "category_id"
    ];

    public function media()
    {
        return $this->morphMany(Media::class, "mediaable");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }
}
