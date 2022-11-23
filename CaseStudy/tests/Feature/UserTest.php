<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
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
    public function test_create_user_by_factory(){
        $user = User::factory(Category::class)->create();// tạo dữ liệu mẫu bằng factory
        $this->assertNotNull($user);// kiểm tra kết qủa trả về có null hay không
    }

    public function test_create_user_by_fillable(){
        $user = new User();
        $data = [
            'name' => $this->faker->name(),
            'email'=> $this->faker->email(),
            'image'=> $this->faker->image(),
            'phone'=> $this->faker->numberBetween(),
            'password'=> $this->faker->md5(),
            'province_id'=> $this->faker->numberBetween(1,63),
            'district_id'=> $this->faker->numberBetween(1,5),
            'ward_id'=> $this->faker->numberBetween(1,5),
        ];
        $this->assertInstanceOf(User::class, $user->create($data));// kiểm tra xem đối tươngj trả về có phải là user không
    }

    public function test_create_user(){
        $user = new User();
        $user->name = $this->faker->name();
        $user->email = $this->faker->email();
        $user->image = $this->faker->image();
        $user->phone = $this->faker->numberBetween();
        $user->password = $this->faker->md5();
        $user->province_id = $this->faker->numberBetween(1,63);
        $user->district_id = $this->faker->numberBetween(1,5);
        $user->ward_id = $this->faker->numberBetween(1,5);
        $this->assertTrue($user->save());
    }

    public function test_update_user(){
        $user = User::where('id','>',0)->orderBy('id','DESC')->first();// lấy kết cuối cùng
        $user->name = $this->faker->name();
        $user->email = $this->faker->email();
        $user->image = $this->faker->image();
        $user->phone = $this->faker->numberBetween();
        $user->password = $this->faker->md5();
        $user->province_id = $this->faker->numberBetween(1,63);
        $user->district_id = $this->faker->numberBetween(1,5);
        $user->ward_id = $this->faker->numberBetween(1,5);
        $this->assertTrue($user->save());//kiểm tra kết quả trả về có true hay không
    }

    public function test_delete_user(){
        $user = User::where('id','>',0)->orderBy('id','DESC')->first();// lấy kết quả cuối cùng
        $this->assertTrue($user->delete());// kiểm tra  kết quả trả về có true hay không
    }

    public function test_restore_user(){
        $user = User::onlyTrashed()->where('id','>',0)->orderBy('id','DESC')->first();// lấy kết quả cuối cùng
        $this->assertTrue($user->restore());// kiểm tra kết quả trả về có true hay không
    }

    public function test_force_delete_user(){
        $user = User::onlyTrashed()->where('id','>',0)->orderBy('id','DESC')->first();// lấy kết quả cuối cùng
        $this->assertTrue($user->forceDelete());// kiểm tra kết quả trả về có true hay không
    }
}
