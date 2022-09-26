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
            'Employee',
            'Customer',
            'Role',
            'Order',
            'Review',
            'Banner',
        ];
        foreach($parentNameGroups as $parentNameGroup){
            $parentGroup = Permission::create([
                'name' => $parentNameGroup, 
                'group_name' => $parentNameGroup,
                'group_key' => 0,
            ]);
           Permission::create([
                'name' => 'List ' . $parentNameGroup,
                'group_name' => 'List_'.$parentNameGroup,
                'group_key' => $parentGroup->id,
            ]);
           Permission::create([
                'name' => 'Show ' . $parentNameGroup,
                'group_name' => 'Show_'.$parentNameGroup,
                'group_key' => $parentGroup->id,
            ]);
           Permission::create([
                'name' => 'Add ' . $parentNameGroup,
                'group_name' => 'Add_'.$parentNameGroup,
                'group_key' => $parentGroup->id,
            ]);
           Permission::create([
                'name' => 'Edit ' . $parentNameGroup,
                'group_name' => 'Edit_'.$parentNameGroup,
                'group_key' => $parentGroup->id,
            ]);
           Permission::create([
                'name' => 'Delete ' . $parentNameGroup,
                'group_name' => 'Delete_'.$parentNameGroup,
                'group_key' => $parentGroup->id,
            ]);
        }
    }
}
