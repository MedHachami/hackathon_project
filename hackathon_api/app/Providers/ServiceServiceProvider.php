<?php

namespace App\Providers;

use App\Services\Contracts\MediaServiceInterface;
use App\Services\Contracts\UploadMediaServiceInterface;
use App\Services\Implementations\MediaService;
use App\Services\Implementations\UploadMediaService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        app()->bind(MediaServiceInterface::class, MediaService::class);
    }
}
