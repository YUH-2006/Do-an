<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; // Đảm bảo bạn đã có Model Admin
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Quản trị viên',
            'email' => 'admin@2006', // Khớp với email trong hình lỗi của bạn
            'password' => Hash::make('123'), // Mật khẩu là 123
        ]);
    }
}