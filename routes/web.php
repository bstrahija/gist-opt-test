<?php

use App\Http\Middleware\GistApiTokenAuthentication;
use App\Models\Activity;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


function request_payload($encode = true)
{
    $input   = (array) request()->all();
    $headers = (array) request()->header();
    $payload = [
        'headers' => $headers,
        'input'   => $input,
    ];

    return $encode ? @json_encode($payload) : $payload;
}

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([GistApiTokenAuthentication::class])->group(function () {
    Route::any('api/init', function () {
        Activity::create([
            'name' => 'init',
            'payload' => request_payload(),
        ]);
        Log::debug('init');
        Log::debug(request_payload());
        Log::debug('======');

        $response = [
            'canvas' => [
                'content' => [
                    'components' => [
                        [
                            'type' => 'text',
                            'text' => 'Hello World!',
                        ]
                    ]
                ],
            ]
        ];

        return $response;
    });

    Route::post('api/submit', function () {
        Activity::create([
            'name' => 'submit',
            'payload' => request_payload(),
        ]);
        Log::debug('submit');
        Log::debug(request_payload());
        Log::debug('======');

        return ['success' => true, 'endpoint' => 'submit'];
    });

    Route::post('api/config', function () {
        Activity::create([
            'name' => 'config',
            'payload' => request_payload(),
        ]);
        Log::debug('config');
        Log::debug(request_payload());
        Log::debug('======');

        return ['api/success' => true, 'endpoint' => 'config'];
    });

    Route::post('api/install', function () {
        Activity::create([
            'name' => 'install',
            'payload' => request_payload(),
        ]);
        Log::debug('install');
        Log::debug(request_payload());
        Log::debug('======');

        return ['success' => true, 'endpoint' => 'install'];
    });

    Route::post('api/uninstall', function () {
        Activity::create([
            'name' => 'uninstall',
            'payload' => request_payload(),
        ]);
        Log::debug('uninstall');
        Log::debug(request_payload());
        Log::debug('======');

        return ['success' => true, 'endpoint' => 'uninstall'];
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
