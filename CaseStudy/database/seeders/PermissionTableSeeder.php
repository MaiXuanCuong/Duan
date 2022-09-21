<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   $permission = new Permission();
        $permission->name = 'user_list';
        $permission->display_name ='Danh Sách User' ;
        $permission->save();

        $permission = new Permission();
        $permission->name = 'user_add';
        $permission->display_name ='Thêm User' ;
        $permission->save();

        $permission = new Permission();
        $permission->name =  'user_edit';
        $permission->display_name ='Sửa User' ;
        $permission->save();

        $permission = new Permission();
        $permission->name =  'user_delete';
        $permission->display_name = 'Xóa User';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'role_list';
        $permission->display_name ='Danh Sách Role' ;
        $permission->save();

        $permission = new Permission();
        $permission->name = 'role_add';
        $permission->display_name ='Thêm Role';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'role_edit';
        $permission->display_name ='Sửa Role';
        $permission->save();

        $permission = new Permission();
        $permission->name =  'role_delete';
        $permission->display_name ='Xóa Role';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'product_add';
        $permission->display_name = 'Thêm Sản Phẩm' ;
        $permission->save();

        $permission = new Permission();
        $permission->name = 'product_edit';
        $permission->display_name = 'Sửa Sản Phẩm' ;
        $permission->save();

        $permission = new Permission();
        $permission->name = 'product_delete';
        $permission->display_name = 'Xóa Sản Phẩm' ;
        $permission->save();
    }
}
