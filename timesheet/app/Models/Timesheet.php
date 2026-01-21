<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timesheet extends Model
{
    use HasFactory;

    protected $table = 'timesheet_listings';

    protected $guarded = [];

    //protected $fillable = ['employee_id', 'date', 'startWork', 'endWork'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
