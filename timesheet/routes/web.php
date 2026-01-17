<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/timesheets', function () {
    return view('timesheets', [
        'timesheets' => [
            [
                'id' => 1,
                'date' => '1/16/2025',
                'startTime' => '7:45 am',
                'endTime' => '4:30 pm',
            ],
            [
                'id' => 2,
                'date' => '1/17/2025',
                'startTime' => '7:45 am',
                'endTime' => '4:30 pm',
            ],
            [
                'id' => 3,
                'date' => '1/18/2025',
                'startTime' => '7:45 am',
                'endTime' => '4:30 pm',
            ],
        ]
    ]);
});

Route::get('/timesheets/{id}', function ($id) {
    $timesheets = [
        [
            'id' => 1,
            'date' => '1/16/2025',
            'startTime' => '7:45 am',
            'endTime' => '4:30 pm',
        ],
        [
            'id' => 2,
            'date' => '1/17/2025',
            'startTime' => '7:45 am',
            'endTime' => '4:30 pm',
        ],
        [
            'id' => 3,
            'date' => '1/18/2025',
            'startTime' => '7:45 am',
            'endTime' => '4:30 pm',
        ],
    ];

    $timesheet = Arr::first($timesheets, fn($timesheet) => $timesheet['id'] == $id);
    return view('timesheet', ['timesheet' => $timesheet]);
});
