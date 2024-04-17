<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Category;

class RankingController extends Controller
{
    public function handle()
    {
        return Category::CategoryRanking(request("category"));
    }
}
