<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class HistoryController extends Controller
{
    public function index()
    {
        $user = JWTAuth::user()->load("projects", "projects.rating");

        return $user;
    }
}
