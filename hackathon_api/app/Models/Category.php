<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        "name"
    ];

    public function ScopeCategoryRanking($query, $id)
    {
        return $query->find($id)
            ->whereHas("projects", function ($query) {
                $query->where("is_rated", true);
            })
            ->with("projects", "projects.rating")
            ->get()
            ->toJson();
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
