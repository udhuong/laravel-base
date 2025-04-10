<?php

namespace Udhuong\Uploader;

use Illuminate\Support\ServiceProvider;
use Udhuong\Uploader\Application\Services\UploadService;
use Udhuong\Uploader\Presentation\Consoles\UploadFileCommand;
use Udhuong\Uploader\Facades\Upload;

class UploaderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->commands([
            UploadFileCommand::class,
        ]);
        $this->mergeConfigFrom(__DIR__ . '/../config/uploader.php', 'uploader');

        $this->app->singleton('upload', function () {
            return new UploadService();
        });
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        $this->publishes([
            __DIR__ . '/../config/uploader.php' => config_path('uploader.php'),
            __DIR__ . '/../../../storage/app/public' => storage_path('app/public'),
        ], 'uploader');
    }
}
