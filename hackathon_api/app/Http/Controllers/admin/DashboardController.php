<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseApiController;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends BaseApiController
{
    public function statistics()
    {
        $data = [
            "statistics" => [
                "latestUsers" => User::where("created_at", ">=", Carbon::today())->count(),
                "totalUsers" => User::count(),
                "latestProjects" => Project::where("created_at", ">=", Carbon::today())->count(),
                "totalProjects" => Project::count(),
            ],
            "users" => User::latest()->take(5)->get(),
        ];

        return $this->sendResponse(
            message: "statistics",
            result: $data
        );
    }
}
