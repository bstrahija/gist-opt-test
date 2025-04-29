<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('init', function () {
    return ['success' => true, 'endpoint' => 'init'];
});

Route::get('submit', function () {
    return ['success' => true, 'endpoint' => 'submit'];
});

Route::get('config', function () {
    return ['success' => true, 'endpoint' => 'config'];
});

Route::get('install', function () {
    return ['success' => true, 'endpoint' => 'install'];
});

Route::get('uninstall', function () {
    return ['success' => true, 'endpoint' => 'uninstall'];
});
