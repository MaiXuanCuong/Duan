<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Product::class);
        $items = Product::search()->paginate(3);
        return view('admin.products.index', compact('items'));
    }
    public function productOutOfStock()
    {
        $this->authorize('viewAny', Product::class);
        $items = Product::search()->where('quantity', '<', 1)->paginate(3);
        $params = [
            'items' => $items,
        ];
        return view('admin.products.outofstock', $params);
    }
    public function create()
    {$this->authorize('create', Product::class);
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }
    public function show($id)
    {
        $this->authorize('view', Product::class);
        $items = Product::findOrFail($id);
        return view('admin.products.show', compact('items'));
    }
    public function store(StoreProductRequest $request)
    {
        $this->authorize('create', Product::class);
        $categories = Category::all();
        $items = Product::all();
        $params = [
            'items' => $items,
            'request' => $request,
            'categories' => $categories,
        ];
        $products = new Product();
        $products->name = $request->name;
        $products->price = $request->price;
        $products->describe = $request->describe;
        $products->configuration = $request->configuration;
        $products->quantity = $request->quantity;
        $products->specifications = $request->specifications;
        $fieldName = 'inputFile';
        if ($request->hasFile($fieldName)) {
            $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
            $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
            $extenshion = $request->file($fieldName)->getClientOriginalExtension();
            $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
            $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
            $path = str_replace('public/', '', $path);
            $products->image = $path;
        }

        $products->color = $request->color;
        $products->price_product = $request->price_product;
        $products->category_id = $request->category_id;
        $products->user_id = Auth()->user()->id;
        try {

            $products->save();
            toast(__('messages.msg_prd_add_ss', ['name' => $request->name]), 'success', 'top-right');
            return redirect()->route('products');
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            $images = str_replace('storage', 'public', $path);
            Storage::delete($images);
            toast(__('messages.msg_prd_add_err', ['name' => $request->name]), 'error', 'top-right');
            return view('admin.products.add', $params);
        }
    }
    public function edit($id)
    {
        $this->authorize('update', Product::class);
        $item = Product::find($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('item', 'categories'));
    }
    public function update(UpdateProductRequest $request, $id)
    {
        $this->authorize('update', Product::class);
        $products = Product::findOrFail($id);
        $products->name = $request->name;
        $products->price = $request->price;
        $products->describe = $request->describe;
        $products->configuration = $request->configuration;
        $products->quantity = $request->quantity;
        $products->specifications = $request->specifications;
        $fieldName = 'inputFile';
        if ($request->hasFile($fieldName)) {
            $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
            $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
            $extenshion = $request->file($fieldName)->getClientOriginalExtension();
            $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
            $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
            $path = str_replace('public/', '', $path);
            $products->image = $path;
        }
        $item = Product::findOrFail($id);
        if (isset($item->image) && isset($path)) {
            $images = str_replace('storage', 'public', $item->image);
        }
        $products->color = $request->color;
        $products->price_product = $request->price_product;
        $products->category_id = $request->category_id;
        try {
            $products->save();
            if (isset($path) && isset($images)) {
                Storage::delete($images);
            }
            toast(__('messages.msg_prd_up_ss', ['name' => $request->name]), 'success', 'top-right');
            return redirect()->route('products');
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            if (isset($path)) {
                $images = str_replace('storage', 'public', $path);
                Storage::delete($images);
            }
            toast(__('messages.msg_prd_up_err', ['name' => $request->name]), 'error', 'top-right');
            return redirect()->route('products.edit', $products->id);
        }
        return redirect()->route('products');
    }
    public function destroy($id)
    {
        $this->authorize('delete', Product::class);
        $item = Product::findOrFail($id);
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
                'message' => 'error',
            ], status:200);
        }
    }
    public function garbageCan()
    {
        $this->authorize('viewgc', Product::class);
        $items = Product::search()->onlyTrashed()->paginate(5);
        return view('admin.products.Garbage_can', compact('items'));

    }
    public function restore($id)
    {
        try {
            $this->authorize('restore', Product::class);
            $item = Product::withTrashed()->where('id', $id);
            $item->restore();
            $item = Product::findOrFail($id);
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);
            return redirect()->route('products.garbageCan');
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return response()->json([
                'code' => 201,
                'message' => 'error',
            ], status:200);
            return redirect()->route('products.garbageCan');
        }
    }
    public function forceDelete($id)
    {
        $this->authorize('forceDelete', Product::class);
        DB::beginTransaction();
        $item = Product::onlyTrashed()->findOrFail($id);
        $images = str_replace('storage', 'public', $item->image);

        $item = Product::withTrashed()->where('id', $id)->forceDelete();
        try {
            Storage::delete($images);
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status:200);
            return redirect()->route('products.garbageCan');
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            DB::rollBack();
            return response()->json([
                'code' => 404,
                'message' => 'error',
            ], status:404);
        }
    }

}
