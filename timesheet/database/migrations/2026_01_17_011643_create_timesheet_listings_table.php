<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Employee;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('timesheet_listings', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('employee_id');
            $table->foreignIdFor(Employee::class);
            $table->string('date');
            $table->string('startTime');
            $table->string('endTime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timesheet_listings');
    }
};
