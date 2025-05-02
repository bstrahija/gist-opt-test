<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'payload',
    ];

    public static function createFromRequest($type = 'init')
    {
        Activity::create([
            'name'    => $type,
            'payload' => self::requestPayload(),
        ]);

        Log::debug('init');
        Log::debug(self::requestPayload(false));
        Log::debug('======');
    }

    public static function respondWithCanvas()
    {
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
    }

    protected static function requestPayload($encode = true)
    {
        $input   = (array) request()->all();
        $headers = (array) request()->header();
        $payload = [
            'headers' => $headers,
            'input'   => $input,
        ];

        return $encode ? @json_encode($payload) : $payload;
    }
}
