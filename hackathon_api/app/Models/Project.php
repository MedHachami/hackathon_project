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
        "student_id",
        "category_id"
    ];
    public function ScopeFilter($query, array $filters)
    {
        $query->when($filters["search"] ?? false, fn($query, $search) => $query
            ->where("name", "like", "%" . $search . "%")
            ->orWhere("description", "like", "%" . $search . "%"));

        $query->when($filters["category"] ?? false, fn($query, $category) => $query
            ->whereHas('category', fn($query) => $query->where("name", $category)
            )
        );
    }
    public function media()
    {
        return $this->morphMany(Media::class, "mediaable");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
