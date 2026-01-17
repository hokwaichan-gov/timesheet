<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timesheet extends Model
{
    use HasFactory;
    protected $table = 'timesheet_listings';
    protected $fillable = ['date', 'startTime', 'endTime'];
}
