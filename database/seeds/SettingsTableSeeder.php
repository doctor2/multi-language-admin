<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $settings = Setting::all();
        foreach ($settings as $setting) {
            $setting->delete();
        }

        $data = [
            [
                'key' => 'projectPreviewWidth',
                'description' => 'Ширина превью изображений(Для проектов, 0 - отсутствие ресайза)',
                'ru' => '800',
                'en' => ''
            ],
            [
                'key' => 'projectPreviewHeight',
                'description' => 'Высота превью изображений(Для проектов, 0 - отсутствие ресайза)',
                'ru' => '800',
                'en' => ''
            ],
            [
                'key' => 'portfolioYear',
                'ru' => 'Год',
                'en' => 'year'
            ],
            [
                'key' => 'portfolioAdditional',
                'ru' => 'Дополнительно',
                'en' => 'additional'
            ],
        ];

        foreach ($data as $value) {
            Setting::create([
                'key' => $value['key'],
                'description' => $value['description'] ?? '',
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
