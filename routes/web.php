<?php

use App\Mail\TestMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redis-test', function () {
    Cache::store('redis')->put('username', 'Maulik', 300);

    return Cache::store('redis')->get('username');
});

Route::get('/mail-test', function () {
    Mail::to('test@example.com')->send(new TestMail);

    return 'Mail sent!';
});
