<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Import;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'thanhnghi1421@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'address' => '123 Man Thien, Tp Thu Duc, tp Ho Chi Minh',
            'dob' => '2001-4-1',
            'phone_number' => '0336593650',
            'working' => true
        ]);

        Customer::create([
            'name' => 'Phan Anh Kiet',
            'email' => 'kiet@gmail.com',
            'phone_number' => '0123123123',
            'address' => '97 Man Thien, tp Thu Duc, tp Ho Chi Minh',
            'created_at' => Carbon::now(),
        ]);

        Category::create([
            'id' => 1,
            'name' => 'Sữa tươi',
            'unit' => 'Thùng'
        ]);

        Reservation::create([
            'id' => 1,
            'category_id' => 1,
            'name' => 'Bảo quản lạnh',
            'description' => 'Nhiệt độ bảo quản dưới 0 độ...'
        ]);

        Reservation::create([
            'id' => 2,
            'category_id' => 1,
            'name' => 'Chống ẩm',
            'description' => 'Đặt ở kệ có khả năng chống ẩm',
        ]);

        Import::create([
            'customer_id' => 1,
            'user_id' => 1,
            'status' => 1,
        ]);
    }
}