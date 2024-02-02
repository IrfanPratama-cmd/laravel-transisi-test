<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_name' => fake()->name(),
            'employee_code' => Str::random(6),
            'company_id' => function () {
                return Company::inRandomOrder()->first()->id;
            },
            'division_id' => function () {
                return Division::inRandomOrder()->first()->id;
            },
            'position_id' => function () {
                return Position::inRandomOrder()->first()->id;
            },
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->randomNumber(8),
            'address' => fake()->sentence(5),
            'entry_date' => now()
        ];
    }
}
