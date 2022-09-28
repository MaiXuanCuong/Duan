<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function home()
    {
        return view('index');
    }
    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $items = Category::all();
        return view('admin.categories.index', compact('items'));
    }
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('admin.categories.add');

    }
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $fieldName = 'inputFile';
        if ($request->hasFile($fieldName)) {
            $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
            $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
            $extenshion = $request->file($fieldName)->getClientOriginalExtension();
            $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
            $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
            $path = str_replace('public/', '', $path);
            $category->image = $path;
        }
        try {
            $category->save();
            toast(__('messages.msg_cate_add_ss', ['name' => $request->name]), 'success', 'top-right');
            return redirect()->route('categories');
        } catch (\Exception$e) {
            toast(__('messages.msg_cate_add_err', ['name' => $request->name]), 'error', 'top-right');
            return view('admin.categories.add', compact('request'));
        }
    }
    public function edit($id)
    {
        $item = Category::find($id);
        $this->authorize('update', Category::class);
        return view('admin.categories.edit', compact('item'));
    }
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $fieldName = 'inputFile';
        if ($request->hasFile($fieldName)) {
            $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
            $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
            $extenshion = $request->file($fieldName)->getClientOriginalExtension();
            $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
            $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
            $path = str_replace('public/', '', $path);
            $category->image = $path;
        }
        $item = Category::findOrFail($id);
        if (isset($item->image) && isset($path)) {
            $images = str_replace('storage', 'public', $item->image);
        }
        try {
            $item->save();
            if (isset($path)) {
                Storage::delete($images);
            }
            $item->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);
        } catch (\Exception$e) {
            $images = $images = str_replace('storage', 'public', $path);
            Storage::delete($images);
            $item->delete();
            return response()->json([
                'code' => 201,
                'message' => 'success',
            ], status:200);
        }
    }
    public function destroy($id)
    {
        $item = Category::findOrFail($id);
        $this->authorize('delete', Category::class);
        try {
            $item->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);
   
        } catch (\Exception$e) {
            return response()->json([
                'code' => 201,
                'message' => 'success',
            ], status:200);
        }

        return response()->json([
            'code' => 200,
            'message' => 'success',
        ], status:200);
    }
    public function garbageCan()
    {
        $items = Category::onlyTrashed()->paginate(5);
        return view('admin.categories.Garbage_can', compact('items'));

    }
    public function restore($id)
    {
        try {
            $item = Category::withTrashed()->where('id', $id);
            $this->authorize('restore', Category::class);
            $item->restore();
            $item = Category::findOrFail($id);
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);
        } catch (\Exception$e) {
            return response()->json([
                'code' => 404,
                'message' => 'failed',
            ], status:200);
        }
    }
    public function forceDelete($id)
    {
        DB::beginTransaction();
        $item = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', Category::class);
        $images = str_replace('storage', 'public', $item->image);
        $items = Category::withTrashed()->where('id', $id)->forceDelete();
        try {
            Storage::delete($images);
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);
        } catch (\Exception$e) {
            return response()->json([
                'code' => 404,
                'message' => 'failed',
            ], status:200);
            DB::rollBack();
        }
    }
}
