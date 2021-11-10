<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;


    /**
     * Define the model's default state.
     */
    #[ArrayShape(['name' => "string", 'email' => "string", 'password' => "mixed|string", 'api_token' => "string", 'remember_token' => "string", 'email_verified_at' => "\Illuminate\Support\Carbon"])]
    public function definition(): array
    {
        static $password;

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $password ?: $password = 'password',
            'api_token' => Str::random(60),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ];
    }

    /**
     * Indicate that the user is anakin.
     */
    public function anakin(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Anakin',
                'email' => 'anakin@skywalker.st'
            ];
        });
    }
}
