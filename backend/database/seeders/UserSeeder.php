<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::truncate();

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@gamil.com';
        $user->password = Hash::make('12345678');
        $user->save();
    }
}
