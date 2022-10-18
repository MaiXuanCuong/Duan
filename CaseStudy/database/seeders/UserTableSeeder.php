<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->name = 'Mai Xuân Cường';
        $user->phone = '0843442357' ;
        $user->email = 'maixuancuong@gmail.com' ;
        $user->password = bcrypt('admin');
        $user->save();
    }
}
