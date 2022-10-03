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
    {  
        $parentNameGroups = [
            'Category',
            'Product',
            // 'User',
            // 'Customer',
            'Role',
            'Admin',
            // 'Order',
            // 'Review',
            // 'Banner',    
        ];
        $nameparent = [
            'Danh Mục',
            'Sản Phẩm',
            'Chức Vụ',
            'Quản Trị Viên',
        ];
        foreach($parentNameGroups as $key => $parentNameGroup){
            $parentGroup = Permission::create([
                'group_name' => $nameparent[$key], 
                'name' => $parentNameGroup,
                'group_key' => 0,
            ]);
           Permission::create([
                'group_name' => 'Xem Trang '.$nameparent[$key],
                'name' => $parentNameGroup.'_viewAny',
                'group_key' => $parentGroup->id,
            ]);
           Permission::create([
                'group_name' => 'Xem Chi Tiết '.$nameparent[$key],
                'name' => $parentNameGroup.'_view',
                'group_key' => $parentGroup->id,
            ]);
           Permission::create([
                'group_name' => 'Thêm '.$nameparent[$key],
                'name' => $parentNameGroup.'_create',
                'group_key' => $parentGroup->id,
            ]);
           Permission::create([
                'group_name' => 'Chỉnh Sửa '.$nameparent[$key],
                'name' => $parentNameGroup.'_update',
                'group_key' => $parentGroup->id,
            ]);
           Permission::create([
                'group_name' => 'Thêm Vào Thùng Rác '.$nameparent[$key],
                'name' => $parentNameGroup.'_delete',
                'group_key' => $parentGroup->id,
            ]);
            Permission::create([
                'group_name' => 'Khôi Phục '.$nameparent[$key],
                'name' => $parentNameGroup.'_restore',
                'group_key' => $parentGroup->id,
            ]);
            Permission::create([
                'group_name' => 'Xóa '.$nameparent[$key],
                'name' => $parentNameGroup.'_forceDelete',
                'group_key' => $parentGroup->id,
            ]);
            Permission::create([
                'group_name' => 'Xem Thùng Rác '.$nameparent[$key],
                'name' => $parentNameGroup.'_viewgc',
                'group_key' => $parentGroup->id,
            ]);
        }
    }
}
