<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = new Role();
        $role->name = 'Admin';
        $role->display_name = 'Quản Trị Viên' ;
        $role->save();

        $role = new Role();
        $role->name = 'Supervisor';
        $role->display_name = 'Người Dám Sát' ;
        $role->save();

        $role = new Role();
        $role->name = 'assistant ';
        $role->display_name = 'Trợ Lý' ;
        $role->save();
    }
}
