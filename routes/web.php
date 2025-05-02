<?php

use App\Http\Middleware\GistApiTokenAuthentication;
use App\Models\Activity;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([GistApiTokenAuthentication::class])->group(function () {
    Route::any('api/init', function () {
        Activity::createFromRequest('init');

        return Activity::respondWithCanvas();
    });

    Route::post('api/submit', function () {
        Activity::createFromRequest('subimt');

        return Activity::respondWithCanvas();
    });

    Route::post('api/config', function () {
        Activity::createFromRequest('config');

        return Activity::respondWithCanvas();
    });

    Route::post('api/install', function () {
        Activity::createFromRequest('install');

        return Activity::respondWithCanvas();
    });

    Route::post('api/uninstall', function () {
        Activity::createFromRequest('uninstall');

        return Activity::respondWithCanvas();
    });

    Route::any('{part}', function () {
        Activity::create([
            'name' => request()->url(),
            'payload' => request_payload(),
        ]);
        Log::debug('other');
        Log::debug(request()->url());
        Log::debug(request_payload());
        Log::debug('======');

        return ['success' => true, 'endpoint' => 'other'];
    });
});
