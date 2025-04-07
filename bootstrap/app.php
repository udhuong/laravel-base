<?php

use App\Presentation\Consoles\SendMailCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('telescope:prune --hours=168')->daily()->withoutOverlapping();
    })
    ->withCommands([
        SendMailCommand::class // Laravel không auto-load folder, chỉ giữ class chính xác với namespace đầy đủ
    ])
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
