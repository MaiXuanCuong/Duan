<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use WithFaker;//tao du lieu gia
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    //test route
    // public function test_route_category()
    // {
    //     $this->get('categories/')->assertStatus(200);//kiem tra URL /category co ton tai voi method GET ko - xem tat ca
    //     $this->get('categories/add')->assertStatus(200);//kiem tra URL /category/create co ton tai voi method GET ko - trang them moi
    //     $this->post('categories/store')->assertStatus(200);//kiem tra URL /category co ton tai voi method POST ko - xu ly them moi
    //     $this->get('categories/destroy/1')->assertStatus(200);//kiem tra URL /category/1 co ton tai voi method GET ko - trang xem chi tiet
    //     $this->get('categories/edit/1')->assertStatus(200);//kiem tra URL /category/1/edit co ton tai voi method GET ko - trang chinh sua
    //     $this->put('categories/garbageCan')->assertStatus(200);//kiem tra URL /category co ton tai voi method PUT ko - xu ly chinh sua
    //     // $this->delete('categories/1')->assertStatus(200);//kiem tra URL /category co ton tai voi method GET ko - xu ly xoa
    //     $this->get('categories/restore/1')->assertStatus(200);//kiem tra URL /category/create co ton tai voi method GET ko - trang them moi
    //     $this->get('categories/update/1')->assertStatus(200);//kiem tra URL /category/create co ton tai voi method GET ko - trang them moi
    //     $this->put('categories/forceDelete/1')->assertStatus(200);//kiem tra URL /category co ton tai voi method PUT ko - xu ly chinh sua
    //     $this->put('categories/search')->assertStatus(200);//kiem tra URL /category co ton tai voi method PUT ko - xu ly chinh sua
      
    // }
    public function test_create_category_by_factory(){
        $category = Category::factory(Category::class)->create();//goi factory de tao moi du lieu
        $this->assertNotNull($category);//kiem tra ket qua tra ve co NULL hay khong
    }

    public function test_create_category_by_fillable(){
        $category = new Category();
        $data = [
            'name' => $this->faker->name,
            'image' => $this->faker->name,
        ];
        $this->assertInstanceOf(Category::class, $category->create($data));//kiem tra ket qua tra ve co phai la doi tuong category ko
    }

    public function test_create_category(){
        $category = new Category();
        $category->name = $this->faker->word;
        $category->image = $this->faker->word;
        $this->assertTrue($category->save());//kiem tra ket qua tra ve co tra ve TRUE hay ko
    }

    public function test_update_category(){
        $category = Category::where('id','>',0)->orderBy('id','DESC')->first();// cập nhật kết quả cuối cùng
        $category->name = "update";
        $category->image = "update";
        $this->assertTrue($category->save());// kiểm tra kết quả trả về có true hay không
    }
    
    public function test_delete_category(){
        $category = Category::where('id','>',0)->orderBy('id','DESC')->first();// lấy kết quả cuối cùng
        $this->assertTrue($category->delete());//kiểm tra kết quả trả về có true hay không
    }

    public function test_restore_category(){
        $category = Category::onlyTrashed()->where('id','>',0)->orderBy('id',"DESC")->first();// lấy kết quả cuối cùng
        $this->assertTrue($category->restore());//kiểm tra kết quả trả về có true hay không
    }

    public function test_force_delete_category(){
        $category = Category::onlyTrashed()->where('id','>',0)->orderBy('id','DESC')->first();//lấy kết quả cuối cùng
        $this->assertTrue($category->forceDelete());// kiểm tra kết quả trả về có true hay không
    }
}
