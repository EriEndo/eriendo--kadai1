<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'gender' => 1,
            'email' => $this->faker->safeEmail,
            'tel' => '00000000000',
            'adress' => '東京都',
            'building' => 'テストマンション',
            'category_id' => 1,
            'detail' => 'テストデータ',
        ];
    }
}
