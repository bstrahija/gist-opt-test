<?php

use App\Models\Activity;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::any('init', function () {
    Activity::create([
        'name' => 'init',
        'payload' => @json_encode(request()->all()),
    ]);

    return ['success' => true, 'endpoint' => 'init'];
});

Route::any('submit', function () {
    Activity::create([
        'name' => 'submit',
        'payload' => @json_encode(request()->all()),
    ]);

    return ['success' => true, 'endpoint' => 'submit'];
});

Route::any('config', function () {
    Activity::create([
        'name' => 'config',
        'payload' => @json_encode(request()->all()),
    ]);

    return ['success' => true, 'endpoint' => 'config'];
});

Route::any('install', function () {
    Activity::create([
        'name' => 'install',
        'payload' => @json_encode(request()->all()),
    ]);

    return ['success' => true, 'endpoint' => 'install'];
});

Route::any('uninstall', function () {
    Activity::create([
        'name' => 'uninstall',
        'payload' => @json_encode(request()->all()),
    ]);

    return ['success' => true, 'endpoint' => 'uninstall'];
});

Route::any('{part}', function () {
    Activity::create([
        'name' => request()->url(),
        'payload' => @json_encode(request()->all()),
    ]);

    return ['success' => true, 'endpoint' => 'uninstall'];
});
