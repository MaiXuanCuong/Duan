<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_role','permission_id','role_id');
    }
    public function users(){
        return $this->belongsToMany(User::class,'user_role','user_id','role_id');
    }
}
