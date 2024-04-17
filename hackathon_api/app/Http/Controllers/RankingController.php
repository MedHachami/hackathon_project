<?php

namespace App\Http\Controllers;

use App\Models\Category;

class RankingController extends Controller
{
    public function handle()
    {
        return Category::CategoryRanking(request("category"));
    }
}
