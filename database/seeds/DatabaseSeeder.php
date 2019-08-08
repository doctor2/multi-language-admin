<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CitiesTableSeeder::class);

        $this->call(SettingsTableSeeder::class);

        App\User::create([
            'name' => 'admin',
            'email' => 'test@test.ru',
            'password' => Hash::make('qwerty'),
        ]);
    }
}
