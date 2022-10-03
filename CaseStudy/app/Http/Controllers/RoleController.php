<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::latest()->paginate(3);
        $params = [
            'roles' => $roles,
        ];
        return view('admin.role.index', $params);
    }
    public function create()
    {
        $this->authorize('create', Role::class);

        // $parent_permissions = DB::table('permissions')->where('parent_id', 0)->get();//bug
        $parent_permissions = Permission::where('group_key', 0)->get();
        $params = [
            'parent_permissions' => $parent_permissions,
        ];
        return view('admin.role.add', $params);
    }
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);
        try {
            $role = Role::create([
                'name' => $request->name,
                'display_name' => $request->display_name,
    
            ]);
            $role->permissions()->attach($request->permissions_id);
            return redirect()->route('role.index');
        } catch (\Exception $e) {
               Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return back()->withInput();
        }
       
    }
    public function edit($id)
    {
        try {
            $this->authorize('update', Role::class);
    
            $role = Role::find($id);
            $permissions_checked = $role->permissions;
            $parent_permissions = Permission::where('group_key', 0)->get();
    
            $params = [
                'role' => $role,
                'permissions_checked' => $permissions_checked,
                'parent_permissions' => $parent_permissions,
            ];
            return view('admin.role.edit', $params);
        } catch (\Exception $e) {
               Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return back()->withInput();
        }
    }
    public function update($id, Request $request)
    {
        try {
        $this->authorize('update', Role::class);

        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        $role->permissions()->sync($request->permissions_id);
        return redirect()->route('role.index');
    } catch (\Exception $e) {
           Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
        return back()->withInput();
    }
    }
    public function delete($id)
    {
        try {
        $this->authorize('delete', Role::class);

        $role = Role::find($id);
        DB::table('permission_roles')->where('role_id', '=', $role->id)->delete();
        Role::find($id)->delete();

        return response()->json([
            'code' => 200,
            'message' => 'success',
        ], status:200);
    } catch (\Exception $e) {
           Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
        return back()->withInput();
    }
    }
    // public function garbageCan()
    // {

    //     $this->authorize('viewgc', Role::class);
    //     $items = User::onlyTrashed()->paginate(3);
    //     return view('admin.user.Garbage_can', compact('items'));

    // }
    // public function restore($id)
    // {
    //     try {
    //         $this->authorize('restore', Role::class);
    //         $item = User::withTrashed()->where('id', $id);
    //         $item->restore();
    //         $item = User::findOrFail($id);
    //         return response()->json([
    //             'code' => 200,
    //             'message' => 'success',
    //         ], status:200);
    //     } catch (\Exception$e) {
    //         return response()->json([
    //             'code' => 404,
    //             'message' => 'failed',
    //         ], status:200);
    //     }
    // }
    // public function forceDelete($id)
    // {
        
    //     $this->authorize('forceDelete', Role::class);
    //     $item = User::onlyTrashed()->findOrFail($id);
    //     $images = str_replace('storage', 'public', $item->image);
    //     try {
    //         User::withTrashed()->where('id', $id)->forceDelete();
    //         Storage::delete($images);
    //         return response()->json([
    //             'code' => 200,
    //             'message' => 'success',
    //         ], status:200);
    //     } catch (\Exception$e) {
    //         return response()->json([
    //             'code' => 201,
    //             'message' => 'error',
    //         ], status:200);
    //     }
    // }
}
