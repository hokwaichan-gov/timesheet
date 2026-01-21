<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timesheet>
 */
class TimesheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'date' => fake()->date(),
            'startWork' => fake()->time(),
            'endWork' => fake()->time(),
            'empInitial' => fake()->randomElement(['ABC', 'XYZ', 'DEF', 'GHI', 'JKL']),
            'status' => fake()->optional()->randomElement(['DO']),
            'vacCtOther' => fake()->optional()->randomElement(['VAC', 'CT', 'WFH', 'OTHER']),
            'mealStart' => fake()->optional()->time(),
            'mealEnd' => fake()->optional()->time(),
            'otHours' => fake()->optional()->randomFloat(2, 0, 8),
        ];
    }
}
