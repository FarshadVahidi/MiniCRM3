<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
     *
     * @return array
     */
    public function definition()
    {
        $company = Company::all()->random(1)->first();
        return [
            'name' => $this->faker->name,
            'lastName'  => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'phone' => $this->faker->phoneNumber,
            'photo' => $this->faker->image('public/storage/image', 300, 300, null, null),
            'company_id'   => $company->id,
            'company_name'  => $company->name,
            'role_id' => 3,
            'role_name' => 'user',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
