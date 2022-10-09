<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $items = Category::search()->paginate(3);
        return view('admin.categories.index', compact('items'));

    }
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('admin.categories.add');

    }
    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('create', Category::class);
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
            if (isset($path)) {

                $images = str_replace('storage', 'public', $path);
                Storage::delete($images);
            }
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());

            toast(__('messages.msg_cate_add_err', ['name' => $request->name]), 'error', 'top-right');
            return view('admin.categories.add', compact('request'));
        }
    }
    public function edit($id)
    {
        $this->authorize('update', Category::class);
        $item = Category::find($id);
        return view('admin.categories.edit', compact('item'));
    }
    public function update(UpdateCategoryRequest $request, $id)
    {
        $this->authorize('update', Category::class);
        $category = Category::findOrFail($id);
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
            $category->save();
            if (isset($path) && isset($images)) {
                Storage::delete($images);
            }
            toast(__('messages.msg_cate_up_ss', ['name' => $request->name]), 'success', 'top-right');
            return redirect()->route('categories');
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());

            if (isset($path)) {
                $images = str_replace('storage', 'public', $path);
                Storage::delete($images);
            }
            toast(__('messages.msg_cate_up_err', ['name' => $request->name]), 'error', 'top-right');
            return redirect()->route('categories.edit', $category->id);
        }
        return redirect()->route('categories');
    }
    public function destroy(Request $request)
    {
        $this->authorize('delete', Category::class);
        $id = $request->id;
        $item = Category::findOrFail($id);
        try {
            $item->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);

        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
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
        $this->authorize('viewgc', Category::class);
        $items = Category::search()->onlyTrashed()->paginate(3);
        return view('admin.categories.Garbage_can', compact('items'));

    }
    public function restore($id)
    {
        try {
            $this->authorize('restore', Category::class);
            $item = Category::withTrashed()->where('id', $id);
            $item->restore();
            $item = Category::findOrFail($id);
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return response()->json([
                'code' => 404,
                'message' => 'failed',
            ], status:200);
        }
    }
    public function forceDelete($id)
    {
        $this->authorize('forceDelete', Category::class);
        $item = Category::onlyTrashed()->findOrFail($id);
        $images = str_replace('storage', 'public', $item->image);
        try {
            Category::withTrashed()->where('id', $id)->forceDelete();
            Storage::delete($images);
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return response()->json([
                'code' => 201,
                'message' => 'error',
            ], status:200);
        }
    }
}
