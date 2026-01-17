<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $table = 'timesheet_listings';
    protected $fillable = ['date', 'startTime', 'endTime'];
}
