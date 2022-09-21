<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $items = Category::all();
        return view('admin.categories.index', compact('items'));
    }
    public function create(){
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
        
        // Session::flash('success', 'Thêm thành công '.$request->name);
        try {
            $categories->save();
            alert()->success('Thêm Danh Mục: '.$request->name,'Thành Công');
            return redirect()->route('categories');
        } catch (\Exception $e) {
            alert()->error('Thêm Danh Mục: '.$request->name, 'Không Thành Công!');
            return view('admin.categories.add',compact('request'));
        }
    }
    public function edit($id){
        $item = Category::find($id);
        return view('admin.categories.edit',compact('item'));
    }
    public function update(StoreCategoryRequest $request, $id){
        $item = Category::find($id);
        $item->name = $request->name;
        try {
            $item->save();
            alert()->success('Lưu Danh Mục: '.$request->name,' Thành Công');
            return redirect()->route('categories');
             // alert('Title','Lorem Lorem Lorem', 'success');
            // alert()->info('Title','Lorem Lorem Lorem');
            // alert()->warning('Title','Lorem Lorem Lorem');
            // alert()->question('Title','Lorem Lorem Lorem');
            // alert()->html('<i>HTML</i> <u>example</u>'," You can use <b>bold text</b>, <a href='//github.com'>links</a> and other HTML tags ",'success');
        } catch (\Exception $e) {
            alert()->error('Lưu Danh Mục: '.$request->name, 'Không Thành Công!');
            return redirect()->route('categories.edit',$item->id);
        }
    }
    public function destroy($id){
        $item = Category::findOrFail($id);
        try {
        $item->delete();

            if(!$item->delete()){
                alert()->success('Xóa Danh Mục: '.$item->name, 'Thành Công');
            }
        } catch (\Exception $e) {
            alert()->error('Xóa Danh Mục: '.$item->name, 'Không Thành Công!');
            return redirect()->route('categories');

        }
         
        
        return redirect()->route('categories');
    }
}
