<?php

use Illuminate\Database\Seeder;
use App\City;

class CitiesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'key' => null,
                'ru' => 'Все',
                'en' => 'All'
            ],
            [
                'key' => 'Tumen',
                'ru' => 'Тюмень',
                'en' => 'Tumen'
            ],
            [
                'key' => 'Moscow',
                'ru' => 'Москва',
                'en' => 'Moscow'
            ],
            [
                'key' => 'Novosibirsk',
                'ru' => 'Новосибирск',
                'en' => 'Novosibirsk'
            ]
        ];

        foreach ($data as $key => $value) {
            City::create([
                'value' => $value['key'],
                config('custom.language_ru') => [
                    'name' => $value['ru']
                ],
                config('custom.language_en') => [
                    'name' => $value['en']
                ]
            ]);
        }
    }
}
