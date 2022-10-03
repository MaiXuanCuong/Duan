<?php

namespace Database\Seeders;

use App\Models\Permission_role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\
        for($i = 1 ; $i <= 36; $i++){
            $user_role = new Permission_role();
            $user_role->role_id = 1;
            $user_role->permission_id = $i;
            $user_role->save();

        }
    }
}
