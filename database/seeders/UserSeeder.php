<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if(!User::where('email', 'miguelmarcondes@gmail.com')->first()){
            User::create([
                'name' => 'Miguel Marcondes',
                'email' => 'miguelmarcondes@gmail.com',
                'password' => Hash::make('123456', ['rounds' => 12]),
            ]);
        }
        if(!User::where('email', 'manuelgomez@gmail.com')->first()){
            User::create([
                'name' => 'Manuel Gomez',
                'email' => 'manuelgomez@gmail.com',
                'password' => Hash::make('324356', ['rounds' => 12]),
            ]);
        }
        if(!User::where('email', 'ednaldoperreira@gmail.com')->first()){
            User::create([
                'name' => 'Ednaldo Perreira',
                'email' => 'ednaldoperreira@gmail.com',
                'password' => Hash::make('398756', ['rounds' => 12]),
            ]);
        }
        if(!User::where('email', 'aoba@gmail.com')->first()){
            User::create([
                'name' => 'Aoba',
                'email' => 'aoba@gmail.com',
                'password' => Hash::make('991756', ['rounds' => 12]),
            ]);
        }
        if(!User::where('email', 'zzzzz@gmail.com')->first()){
            User::create([
                'name' => 'Zzzzz',
                'email' => 'zzzzz@gmail.com',
                'password' => Hash::make('991756', ['rounds' => 12]),
            ]);
        }
    }
}