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
            // 'Role',
            // 'Order',
            // 'Review',
            // 'Banner',    
        ];
        foreach($parentNameGroups as $parentNameGroup){
            $parentGroup = Permission::create([
                'group_name' => $parentNameGroup, 
                'name' => $parentNameGroup,
                'group_key' => 0,
            ]);
           Permission::create([
                'group_name' => 'List ' . $parentNameGroup,
                'name' => $parentNameGroup.'_viewAny',
                'group_key' => $parentGroup->id,
            ]);
           Permission::create([
                'group_name' => 'Show ' . $parentNameGroup,
                'name' => $parentNameGroup.'_view',
                'group_key' => $parentGroup->id,
            ]);
           Permission::create([
                'group_name' => 'Add ' . $parentNameGroup,
                'name' => $parentNameGroup.'_create',
                'group_key' => $parentGroup->id,
            ]);
           Permission::create([
                'group_name' => 'Edit ' . $parentNameGroup,
                'name' => $parentNameGroup.'_update',
                'group_key' => $parentGroup->id,
            ]);
           Permission::create([
                'group_name' => 'Delete ' . $parentNameGroup,
                'name' => $parentNameGroup.'_delete',
                'group_key' => $parentGroup->id,
            ]);
            Permission::create([
                'group_name' => 'Restore ' . $parentNameGroup,
                'name' => $parentNameGroup.'_restore',
                'group_key' => $parentGroup->id,
            ]);
            Permission::create([
                'group_name' => 'ForceDelete' . $parentNameGroup,
                'name' => $parentNameGroup.'_forceDelete',
                'group_key' => $parentGroup->id,
            ]);
        }
    }
}
