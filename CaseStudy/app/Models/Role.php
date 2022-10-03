<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use App\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Role extends Model
{
    use HasFactory;
    // use SoftDeletes;// add soft delete
    protected $guarded = [];
    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_roles','role_id','permission_id');
    }
    public function users(){
        return $this->belongsToMany(User::class,'user_roles','user_id','role_id');
    }
}
