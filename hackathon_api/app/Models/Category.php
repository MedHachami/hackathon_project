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
        return $query
            ->with(['projects' => function ($query) {
                $query->where('is_rated', true)
                    ->with('rating');
            }])
            ->find($id)
            ->projects
            ->sortByDesc('rating.note')
            ->values()
            ->toJson();
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
