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
