<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/timesheet', function () {
    return view('timesheet');
});
