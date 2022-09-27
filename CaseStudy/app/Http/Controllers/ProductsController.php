<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Product::class);
        $items = Product::paginate(5);
        return view('admin.products.index', compact('items'));
    }
    public function create()
    {   $this->authorize('create', Product::class);
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }
    public function show($id){
        $this->authorize('view', Product::class);
        $items = Product::findOrFail($id);
        return view('admin.products.show', compact('items'));
    }
    public function store(StoreProductRequest $request)
    {
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
        $products->garbage_can = 1;
        $products->category_id = $request->category_id;
        $products->user_id = Auth()->user()->id;
        try {
           
            $products->save();
            // alert()->success('Thêm Sản Phẩm: ' . $request->name, 'Thành Công');
            toast(__('messages.msg_prd_add_ss',['name' => $request->name]),'success','top-right');
            return redirect()->route('products');
        } catch (\Exception$e) {
            $images = str_replace('storage', 'public', $path);
            Storage::delete($images);
            // alert()->error('Thêm Sản Phẩm: ' . $request->name, 'Không Thành Công!');
            toast(__('messages.msg_prd_add_err',['name' => $request->name]),'error','top-right');
            // return redirect()->route('products');
            return view('admin.products.add', $params);
        }
    }
    public function edit($id)
    {
        $item = Product::find($id);
        $this->authorize('update', $item);
        $categories = Category::all();
        return view('admin.products.edit', compact('item', 'categories'));
    }
    public function update(UpdateProductRequest $request, $id)
    {
        $products = Product::find($id);
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
        $products->garbage_can = 1;
        $products->category_id = $request->category_id;
        // Session::flash('success', 'Chỉnh sửa thành công '.$request->name);
        try {
            $products->save();
            if(isset($path)){
                Storage::delete($images);
            }
            // alert()->success('Lưu Sản Phẩm: ' . $request->name, 'Thành Công');
            toast(__('messages.msg_prd_up_ss',['name' => $request->name]),'success','top-right');
            return redirect()->route('products');

        } catch (\Exception $e) {
            // $products = Product::find($id);
            $images = $images = str_replace('storage', 'public', $path);
            Storage::delete($images);
            // alert()->error('Lưu Sản Phẩm: ' . $request->name, 'Không Thành Công!');
            toast(__('messages.msg_prd_up_err',['name' => $request->name]),'error','top-right');
            return redirect()->route('products.edit',$products->id);
        }
        return redirect()->route('products');
    }
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $this->authorize('delete', $item);
        try {
            $item->delete();
            // alert()->success('Xóa Sản Phẩm: ' . $item->name, 'Thành Công');
            toast(__('messages.msg_prd_dele_ss',['name' => $item->name]),'success','top-right');
            return redirect()->route('products');

        } catch (\Exception$e) {
            // alert()->error('Xóa Sản Phẩm: ' . $item->name, 'Không Thành Công!');
            toast(__('messages.msg_prd_dele_err',['name' => $item->name]),'error','top-right');
            return redirect()->route('products');
        }
        // Session::flash('success', 'Xóa thành công '.$item->name);
    }

    public function garbageCan(){
        $items = Product::onlyTrashed()->paginate(5);
        return view('admin.products.Garbage_can', compact('items'));
     
    }
    public function restore($id){
        try {
            $item = Product::withTrashed()->where('id', $id);
            $this->authorize('restore', $item);
            $item->restore();
            $item = Product::findOrFail($id);
            alert()->success('Khôi Phục Sản Phẩm: ' . $item->name, 'Thành Công');
            return redirect()->route('products.garbageCan');
        } catch (\Exception$e) {
            alert()->error('Khôi Phục Sản Phẩm: ' . $item->name, 'Không Thành Công!');
            return redirect()->route('products.garbageCan');
        }
        //Xoá record vĩnh viễn: App\User::withTrashed()->where('id', 1)->forceDelete();
        //Để lấy lại record đã xoá bằng softDeletes: App\User::withTrashed()->where('id', 1)->restore();
    }
    public function forceDelete($id){
        DB::beginTransaction();
        $item = Product::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $item);
        // dd($product);
        $images = str_replace('storage', 'public', $item->image);
      
        $item = Product::withTrashed()->where('id', $id)->forceDelete();
        try {
            // alert()->success('Xóa Sản Phẩm: ' . $product->name, 'Thành Công');
            toast(__('messages.msg_prd_dele_ss',['name' => $item->name]),'success','top-right');
            Storage::delete($images);
            DB::commit();
            return redirect()->route('products.garbageCan');
        } catch (\Exception$e) {
            // alert()->error('Xóa Sản Phẩm: ' . $product->name, 'Không Thành Công!');
            toast(__('messages.msg_prd_dele_err',['name' => $item->name]),'error','top-right');
            DB::rollBack();
            return redirect()->route('products.garbageCan');
        }
    }

}
