<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'employee_name' => $this->faker->name(),
            'employee_number' => $this->faker->unique()->numberBetween(1000, 9999),
            'mobile_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
          'note' => $this->faker->sentence(),
     
        ];
    }
}
