<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    public function roles(){
        return $this->belongsToMany(Role::class,'permission_roles','permission_id','role_id');
    }
    function childrentPermissions(){
        return $this->hasMany(Permission::class, 'group_key', 'id');
    }
}
