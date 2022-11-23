<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
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
    public function test_create_product_by_factory(){
        $product = Product::factory(Product::class)->create();// gọi factory để tạo mới dữ liệu
        $this->assertNotNull($product);// kiểm tra kết quả trả về có null hay không
    }

    public function test_create_product_by_fillable(){
        $product = new Product();
        $data = [
            'name' => $this->faker->name(),
            'image' => $this->faker->imageUrl(360, 360, 'animals', true, 'dogs', true),
            'describe' => $this->faker->sentence(),
            'configuration' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(0,1000),
            'specifications' => $this->faker->word(),
            'color' => $this->faker->colorName(),
            'price_product' => $this->faker->numberBetween(),
            'price' => $this->faker->numberBetween(),
            'category_id' => mt_rand(1,2),
            'user_id' => mt_rand(1,1),
        ];
        $this->assertInstanceOf(Product::class, $product->create($data));
    }

    public function test_create_product(){
        $product = new Product();
        $product->name = $this->faker->name();
        $product->image = $this->faker->imageUrl(360, 360, 'animals', true, 'dogs', true);
        $product->describe = $this->faker->word();
        $product->configuration = $this->faker->word();
        $product->quantity = $this->faker->numberBetween(0,1000);
        $product->specifications = $this->faker->word();
        $product->color = $this->faker->colorName();
        $product->price_product = $this->faker->numberBetween();
        $product->price = $this->faker->numberBetween();
        $product->category_id = mt_rand(1,2);
        $product->user_id = mt_rand(1,1);
        $this->assertTrue($product->save());//kiểm tra xem kết quả có trả về true hay không

    }

    public function test_update_product(){
        $product = Product::where('id','>',0)->first();// lấy kết quả đầu tiên
        $product->name = $this->faker->name();
        $product->image = $this->faker->image(null, 640, 480);
        $product->describe = $this->faker->sentence();
        $product->configuration = $this->faker->sentence();
        $product->quantity = $this->faker->numberBetween(100,1000);
        $product->specifications = $this->faker->sentence();
        $product->color = $this->faker->colorName();
        $product->price_product = $this->faker->numberBetween();
        $product->price = $this->faker->numberBetween();
        $product->category_id = mt_rand(1,2);
        $product->user_id = mt_rand(1,1);
        $this->assertTrue($product->save());//kiểm tra xem kết quả có trả về true hay không
    }

    public function test_delete_product(){
        $product = Product::where('id','>',0)->orderBy('id','DESC')->first();// lấy kết qua cuối cùng
        $this->assertTrue($product->delete());
    }

    public function test_restore_product(){
        $product = Product::onlyTrashed()->where('id','>',0)->orderBy('id','DESC')->first();// lấy kết quả cuối cùng
        $this->assertTrue($product->restore());//kiểm tra kết quả trả về có true hay không
    }

    public function test_force_delete_product(){
        $product = Product::onlyTrashed()->where('id','>',0)->orderBy('id','DESC')->first();// lấy kết quả cuối cùng
        $this->assertTrue($product->forceDelete());// kiểm tra kết quả trả về có true hay không
    }
}
