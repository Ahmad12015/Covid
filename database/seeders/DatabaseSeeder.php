<?php

namespace Database\Seeders;

use App\Models\ContactMap;
use App\Models\patient;
use App\Models\PlaceHolder;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Samer Ayash',
            'email' => 'sam@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'type'=>1,
            'remember_token' => Str::random(10),
        ]);
         User::factory(10)->create();
         patient::factory(100)->create();
         ContactMap::factory(50)->create();
         PlaceHolder::factory(50)->create();
    }
}
