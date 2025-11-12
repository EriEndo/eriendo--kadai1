<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);

        Contact::factory()->count(20)->create([
            'last_name' => '山田',
            'first_name' => '太郎',
            'gender' => 1,
            'email' => 'test@example.com',
            'tel' => '08012345678',
            'adress' => '東京都渋谷区千駄ヶ谷1-2-3',
            'building' => '千駄ヶ谷マンション101',
            'category_id' => 2,
            'detail' => "届いた商品が注文した商品ではありませんでした。\n商品の交換をお願いします。",
            'created_at'    => Carbon::create(2025, 11, 1, 00, 00, 0),
        ]);

        Contact::factory()->count(20)->create([
            'last_name' => '田中',
            'first_name' => '花子',
            'gender' => 2,
            'email' => 'coachtech@example.com',
            'tel' => '09011112222',
            'adress' => '東京都港区',
            'building' => 'オフィスビル202',
            'category_id' => 3,
            'detail' => "届いた商品に汚れがついていました。\n返品と返金をお願いします。",
            'created_at'    => Carbon::create(2025, 11, 10, 00, 00, 0),
        ]);
    }
}
