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
        $components = [
            [
                'type' => 'text',
                'text' => '**Name:** dummy@user.com',
            ],
            [
                'type' => 'text',
                'text' => '**Stripe Customer ID:** 123456789',
            ],
            [
                'type' => 'text',
                'text' => '**Plan:** Some plan',
            ],
            [
                'type' => 'text',
                'text' => '**Legacy:** No',
            ],
            [
                'type' => 'text',
                'text' => '**Created date:** 2025-05-01 10:00:00',
            ],
            [
                'type' => 'text',
                'text' => '**Renewal Date:** 2026-05-01 10:00:00',
            ],
            [
                'type' => 'text',
                'text' => '**Status:** Active',
            ],
            [
                'type' => 'text',
                'text' => '**Domain Limit:** 9999',
            ],
            [
                'type' => 'text',
                'text' => '**Conmfirmed:** Yes',
            ],
        ];

        // $components = [
        //     [
        //         'type' => 'text',
        //         'text' => 'Under construction',
        //     ]
        //     ];

        $response = [
            'canvas' => [
                'content' => [
                    'components' => $components,
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
