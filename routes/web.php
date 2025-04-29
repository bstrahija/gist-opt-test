<?php

use App\Models\Activity;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});

Route::post('init', function () {
    Activity::create([
        'name' => 'init',
        'payload' => @json_encode(request()->all()),
    ]);
    Log::debug('init');
    Log::debug(request()->all());
    Log::debug('======');

    // Request data example
    // {
    //     "workspace_id": "abcd123",
    //     "admin": { / Object: See link in table for the full object / },
    //     "conversation": { / Object: See link in table for the full object / },
    //     "contact": { / Object: See link in table for the full object / },
    //     "context": { / Object: See link in table for the full object / },
    //     "card_creation_options": { "key": "value" } //can be more than one pair
    // }

    // Example response
    // { "canvas": {
    //     A canvas object with content and components / }
    // }

    return ['success' => true, 'endpoint' => 'init'];
});

Route::post('submit', function () {
    Activity::create([
        'name' => 'submit',
        'payload' => @json_encode(request()->all()),
    ]);
    Log::debug('submit');
    Log::debug(request()->all());
    Log::debug('======');

    return ['success' => true, 'endpoint' => 'submit'];
});

Route::post('config', function () {
    Activity::create([
        'name' => 'config',
        'payload' => @json_encode(request()->all()),
    ]);
    Log::debug('config');
    Log::debug(request()->all());
    Log::debug('======');

    return ['success' => true, 'endpoint' => 'config'];
});

Route::post('install', function () {
    Activity::create([
        'name' => 'install',
        'payload' => @json_encode(request()->all()),
    ]);
    Log::debug('install');
    Log::debug(request()->all());
    Log::debug('======');

    return ['success' => true, 'endpoint' => 'install'];
});

Route::post('uninstall', function () {
    Activity::create([
        'name' => 'uninstall',
        'payload' => @json_encode(request()->all()),
    ]);
    Log::debug('uninstall');
    Log::debug(request()->all());
    Log::debug('======');

    return ['success' => true, 'endpoint' => 'uninstall'];
});

Route::any('{part}', function () {
    Activity::create([
        'name' => request()->url(),
        'payload' => @json_encode(request()->all()),
    ]);
    Log::debug('other');
    Log::debug(request()->url());
    Log::debug(request()->all());
    Log::debug('======');

    return ['success' => true, 'endpoint' => 'other'];
});
