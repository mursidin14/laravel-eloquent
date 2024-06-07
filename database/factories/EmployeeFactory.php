<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    
    public function definition()
    {
        return [
            'id' => '',
            'name' => '',
            'title' => '',
            'salary' => 0
        ];
    }

    public function programmer(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'title' => 'programmer',
                'salary' => 5000000
            ];
        });
    }

    public function seniorProgrammer(): Factory
    {
        return $this->state(function(array $attributes) {
            return [
                'title' => 'senior programmer',
                'salary' => 10000000
            ];
        });
    }
}
