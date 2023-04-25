<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class newsModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => Str::random(10),
            'short_desc' => Str::random(20),
            'desc' => Str::random(100),
            'created_at' => now(),
            'updated_at' => now(),
            'image' =>   "test.jpg", //Str::random(10),
            'status' =>   1,
        ];
    }
}
