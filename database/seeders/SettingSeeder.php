<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setMany([
            'defualt_locale' => 'ar',
            'defualt_timezone' => 'Africa\Cairo',
            'reviews_enabled' => true,
            'auto_approve_reviews' => true,
            'supported_currencies' => ['USD', 'LE', 'SAR'],
            'default_currency' => 'LE',
            'store_email' => 'admin@store.text',
            'search_engine' => 'mysql',
            'local_shipping_cost' => 0,
            'outer_shipping_cost' => 0,
            'free_shipping_cost'  => 0,
            'translatable' => [
                'store_name'           => ' متجرالعرب',
                'free_shipping_label'  => ' توصيل مجاني',
                'local_label'          => 'توصيل داخلي ',
                'outer_shipping_label' => 'توصيل خارجي  '
            ]
        ]);
    }
}