<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Aler;
use App\Http\Requests\StoreCategoryRequest;

class CategoriesController extends Controller
{
    //
    public function home(){

        // $items = Category::all();
        // return view('index',compact('items'));
        return view('index');
    }
    public function index(){
        $this->authorize('viewAny', Category::class);
        $items = Category::all();
        return view('admin.categories.index', compact('items'));
    }
    public function create(){
        $this->authorize('create', Category::class);
        return view('admin.categories.add');

    }
    
    public function store(StoreCategoryRequest $request){

           // $roles = [
        //     'name'          => 'required|min:3|unique:products',
        //     'price'         => 'required',
        //     'description'   => 'required',
        // ];
        // $messages = [
        //     'min' => 'Bat buoc lon hon',
        //     'name.required' => 'Ban chua nhap ten',
        //     'price.required' => 'Ban chua nhap gia',
        // ];
        // // $request->validate($roles,$messages);//that bai => create
        // $validator = Validator::make( $request->all(),$roles,$messages);

        // // Neu that bai
        // if ($validator->fails()) {
        //     return redirect()->route('products.create')
        //             ->withErrors($validator) //kem theo loi
        //             ->withInput()//kem gia tri cu
        //             ;
        // }
        
        $categories = new Category();
        $categories->name = $request->name;
        $fieldName = 'inputFile';
        if ($request->hasFile($fieldName)) {
            $fullFileNameOrigin = $request->file($fieldName)->getClientOriginalName();
            $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
            $extenshion = $request->file($fieldName)->getClientOriginalExtension();
            $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
            $path = 'storage/' . $request->file($fieldName)->storeAs('public/images', $fileName);
            $path = str_replace('public/', '', $path);
            $categories->image = $path;
        }
        
        // Session::flash('success', 'Thêm thành công '.$request->name);
        try {
            $categories->save();
            // alert()->success('Thêm Danh Mục: '.$request->name,'Thành Công');
            toast(__('messages.msg_cate_add_ss',['name' => $request->name]),'success','top-right');
            return redirect()->route('categories');
        } catch (\Exception $e) {
            // alert()->error('Thêm Danh Mục: '.$request->name, 'Không Thành Công!');
            toast(__('messages.msg_cate_add_err',['name' => $request->name]),'error','top-right');
            return view('admin.categories.add',compact('request'));
        }
    }
    public function edit($id){
        $item = Category::find($id);
        $this->authorize('update', Category::class);
        return view('admin.categories.edit',compact('item'));
    }
    public function update(StoreCategoryRequest $request, $id){
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
            if(isset($path)){
                Storage::delete($images);
            }
            // alert()->success('Lưu Danh Mục: '.$request->name,' Thành Công');
            toast(__('messages.msg_cate_up_err',['name' => $request->name]),'success','top-right');

            return redirect()->route('categories');
             // alert('Title','Lorem Lorem Lorem', 'success');
            // alert()->info('Title','Lorem Lorem Lorem');
            // alert()->warning('Title','Lorem Lorem Lorem');
            // alert()->question('Title','Lorem Lorem Lorem');
            // alert()->html('<i>HTML</i> <u>example</u>'," You can use <b>bold text</b>, <a href='//github.com'>links</a> and other HTML tags ",'success');
        } catch (\Exception $e) {
            $images = $images = str_replace('storage', 'public', $path);
            Storage::delete($images);
            // alert()->error('Lưu Danh Mục: '.$request->name, 'Không Thành Công!');
            toast(__('messages.msg_cate_up_err',['name' => $request->name]),'error','top-right');

            return redirect()->route('categories.edit',$item->id);
        }
    }
    public function destroy($id){
        $item = Category::findOrFail($id);
        $this->authorize('delete', Category::class);
        try {
        $item->delete();

            if(!$item->delete()){
                // alert()->success('Xóa Danh Mục: '.$item->name, 'Thành Công');
                toast(__('messages.msg_cate_dele_err',['name' => $item->name]),'success','top-right');
            }
        } catch (\Exception $e) {
            // alert()->error('Xóa Danh Mục: '.$item->name, 'Không Thành Công!');
            toast(__('messages.msg_cate_dele_err',['name' => $item->name]),'error','top-right');
            return redirect()->route('categories');

        }
         
        
        return redirect()->route('categories');
    }
    public function garbageCan(){
        $items = Category::onlyTrashed()->paginate(5);
        return view('admin.categories.Garbage_can', compact('items'));
     
    }
    public function restore($id){
        try {
            $item = Category::withTrashed()->where('id', $id);
            $this->authorize('restore', Category::class);
            $item->restore();
            $item = Category::findOrFail($id);
            alert()->success('Khôi Phục Sản Phẩm: ' . $item->name, 'Thành Công');
            return redirect()->route('categories.garbageCan');
        } catch (\Exception$e) {
            alert()->error('Khôi Phục Sản Phẩm: ' . $item->name, 'Không Thành Công!');
            return redirect()->route('categories.garbageCan');
        }
        //Xoá record vĩnh viễn: App\User::withTrashed()->where('id', 1)->forceDelete();
        //Để lấy lại record đã xoá bằng softDeletes: App\User::withTrashed()->where('id', 1)->restore();
    }
    public function forceDelete($id){
        DB::beginTransaction();
        $item = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', Category::class);
        // dd($Category);
        $images = str_replace('storage', 'public', $item->image);
      
        $item = Category::withTrashed()->where('id', $id)->forceDelete();
        try {
            // alert()->success('Xóa Sản Phẩm: ' . $Category->name, 'Thành Công');
            toast(__('messages.msg_cate_dele_ss',['name' => $item->name]),'success','top-right');
            Storage::delete($images);
            DB::commit();
            return redirect()->route('categories.garbageCan');
        } catch (\Exception$e) {
            // alert()->error('Xóa Sản Phẩm: ' . $Category->name, 'Không Thành Công!');
            toast(__('messages.msg_cate_dele_err',['name' => $item->name]),'error','top-right');
            DB::rollBack();
            return redirect()->route('categories.garbageCan');
        }
    }
}
