<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
    Setting::insert([
        'key' => 'price_per_litre',
        'value'=> '200',
    ]);
    }
}
