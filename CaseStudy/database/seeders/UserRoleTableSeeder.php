<?php

namespace Database\Seeders;

use App\Models\User_role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_role = new User_role();
        $user_role->user_id = 1;
        $user_role->role_id = 1;
        $user_role->save();
    }
}
