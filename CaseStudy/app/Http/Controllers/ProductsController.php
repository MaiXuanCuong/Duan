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
    //
    public function index()
    {
        // $items = Product::all();
        $items = Product::paginate(5);

        // dd($items[0]->category->name);
        // $items = Product::all();
        return view('admin.products.index', compact('items'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        // $array = $request->toArray();
        // if(count($array) == 11){
        // dd($request->toArray());
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
        // dd($request);
        $products->configuration = $request->configuration;
        $products->quantity = $request->quantity;
        $products->specifications = $request->specifications;

        // $products->image = $request->inputFile ;
        // $request->file('inputFile')->store('public/images');
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
        // dd($products->user_id);

        try {
            $products->save();
            alert()->success('Thêm Sản Phẩm: ' . $request->name, 'Thành Công');
            return redirect()->route('products');
        } catch (\Exception$e) {
            $images = str_replace('storage', 'public', $path);
            Storage::delete($images);
            alert()->error('Thêm Sản Phẩm: ' . $request->name, 'Không Thành Công!');
            // return redirect()->route('products');
            return view('admin.products.add', $params);
        }
        // toast('Your Post as been submited!','success','top-right');
        // }
        //  Session::flash('success', 'Thêm thành công '.$request->name);
        // return redirect()->route('products.add');
    }
    public function edit($id)
    {
        $item = Product::find($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('item', 'categories'));
    }
    public function update(UpdateProductRequest $request, $id)
    {
        // dd($request->name);
       
        $products = Product::find($id);
        $products->name = $request->name;
        $products->price = $request->price;
        $products->describe = $request->describe;
        $products->configuration = $request->configuration;

        // dd($request);
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
            alert()->success('Lưu Sản Phẩm: ' . $request->name, 'Thành Công');
            return redirect()->route('products');

        } catch (\Exception$e) {
            // $products = Product::find($id);
            $images = $images = str_replace('storage', 'public', $path);
            Storage::delete($images);
            alert()->error('Lưu Sản Phẩm: ' . $request->name, 'Không Thành Công!');
            return redirect()->route('products.edit',$products->id);
        }
        return redirect()->route('products');
    }
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
       
        try {
            $item->delete();
            alert()->success('Xóa Sản Phẩm: ' . $item->name, 'Thành Công');
            return redirect()->route('products');

        } catch (\Exception$e) {
            alert()->error('Xóa Sản Phẩm: ' . $item->name, 'Không Thành Công!');
            return redirect()->route('products');
        }
        // Session::flash('success', 'Xóa thành công '.$item->name);
    }

    public function deleted(){
        $items = Product::onlyTrashed()->paginate(5);
        return view('admin.products.Garbage_can', compact('items'));
     
    }
    public function recover($id){
       
        try {
            $item = Product::withTrashed()->where('id', $id)->restore();
            $item = Product::findOrFail($id);
            alert()->success('Khôi Phục Sản Phẩm: ' . $item->name, 'Thành Công');
            return redirect()->route('products.deleted');
        } catch (\Exception$e) {
            alert()->error('Khôi Phục Sản Phẩm: ' . $item->name, 'Không Thành Công!');
            return redirect()->route('products.deleted');
        }
        //Xoá record vĩnh viễn: App\User::withTrashed()->where('id', 1)->forceDelete();
        //Để lấy lại record đã xoá bằng softDeletes: App\User::withTrashed()->where('id', 1)->restore();
    }
    public function delete($id){
        DB::beginTransaction();
        $product = Product::onlyTrashed()->findOrFail($id);
        // dd($product);
        $images = str_replace('storage', 'public', $product->image);
      
        $item = Product::withTrashed()->where('id', $id)->forceDelete();
        try {
            alert()->success('Xóa Sản Phẩm: ' . $product->name, 'Thành Công');
            Storage::delete($images);
            DB::commit();
            return redirect()->route('products.deleted');
        } catch (\Exception$e) {
            alert()->error('Xóa Sản Phẩm: ' . $product->name, 'Không Thành Công!');
            DB::rollBack();
            return redirect()->route('products.deleted');
        }
    }



}
