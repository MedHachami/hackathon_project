<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class HistoryController extends Controller
{
    public function index()
    {
        $user = JWTAuth::user()->load("projects", "projects.rating");
        return $user;
    }
}
