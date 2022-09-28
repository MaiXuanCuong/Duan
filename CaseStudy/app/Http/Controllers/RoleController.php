<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller {
    function index() {
        $roles = Role::latest()->paginate(2);
        $params = [
            'roles' => $roles
        ];
        return view('admin.role.index', $params);
    }
    function create() {
        // $parent_permissions = DB::table('permissions')->where('parent_id', 0)->get();//bug
        $parent_permissions = Permission::where('group_key', 0)->get();
        $params = [
            'parent_permissions' => $parent_permissions
        ];
        return view('admin.role.add', $params);
    }
    function store(Request $request) {
        $role = Role::create([
            'name' => $request->name
        ]);
        $role->permisstions()->attach($request->permissions_id);
        return redirect()->route('role.index');
    }
    function edit($id) {
        $role = Role::find($id);
        $permissions_checked = $role->permisstions;
        $parent_permissions = Permission::where('group_key', 0)->get();

        $params = [
            'role' => $role,
            'permissions_checked' => $permissions_checked,
            'parent_permissions' => $parent_permissions
        ];
        return view('admin.role.edit', $params);
    }
    function update($id, Request $request) {
        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permisstions()->sync($request->permissions_id);
        return redirect()->route('role.index');
    }
    function delete($id) {
        $role = Role::find($id);
        Role::find($id)->delete();
        DB::table('permission_roles')->where('role_id', '=', $role->id)->delete();

        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], status: 200);
    }
}