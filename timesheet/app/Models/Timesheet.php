<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Timesheet
{
    public static function all(): array
    {
        return [
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
    }

    public static function find(int $id): array
    {
        $timesheet = Arr::first(static::all(), fn($timesheet) => $timesheet['id'] == $id);

        if (! $timesheet) {
            abort(404);
        }

        return $timesheet;
    }
}
