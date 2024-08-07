<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->name = "Administrator";
        $admin->email = "admin@gmail.com";
        $admin->password = bcrypt('12345678');
        $admin->save();

        $kasir = new User();
        $kasir->name = "Kasir";
        $kasir->email = "kasir@gmail.com";
        $kasir->password = bcrypt('12345678');
        $kasir->save();


    }
}
