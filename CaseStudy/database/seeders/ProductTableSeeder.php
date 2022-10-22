<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//         '1 rl
// 2ap
// 3ss
// 4xi';
        $role = new Product();
        $role->name = 'Iphone 13 pro max';
        $role->price = 25000000;
        $role->describe = 'Mô tả sản phẩm:
        iPhone 13 Pro Max chính hãng VN/A mới siêu lướt chính hãng đổi/ trả bảo hành, hàng xuất Viettel. Bộ sản phẩm chuẩn Fullbox gồm hộp chính hãng Việt Nam, thân máy, dây sạc USB C to Lightning, sách HDSD, que chọc sim. Sản phẩm đã kích hoạt/ chưa kích hoạt, bảo hành còn rất dài
        Số lượng có hạn, mời các bạn đặt hàng sớm tránh tình trạng hết hàng.';
        $role->quantity = 213;
        $role->specifications = 'Thẻ SIM:	Nano + eSim;
        Màn hình:  6.7 inches, Super Retina XDR OLED, 120Hz, HDR10, Dolby Vision;
        Độ phân giải:	1284 x 2778 pixels, tỷ lệ 19.5:9;
        CPU:  Apple A15 Bionic (5 nm);
        RAM:  6GB;
        Bộ nhớ/ Thẻ nhớ:  128/256/512GB/1TB;
        Camera sau:  12 MP, f/1.5, 26mm (wide), 1.9µm, dual pixel PDAF, sensor-shift OIS, 12 MP, 12 MP;
        Camera trước:	12 MP, f/2.2, 23mm (wide), 1/3.6";
        Jack 3.5mm/ Loa:	Không/ Loa kép Stereo;
        Pin:	4373mAh, sạc nhanh 27W;
        Màu sắc:	Xanh, Xám, Vàng, Trắng';
        $role->color = 'Trắng;Đen;Vàng;Xanh';
        $role->price_product = '25000000;29000000;37000000;45000000';
        $role->configuration = '128GB;256GB;512GB;1TB';
        $role->category_id  = 2;
        $role->user_id = 1;
        $role->image = 'storage/images/13prm.jpg';
        $role->save();

        $role = new Product();
        $role->name = 'Realme GT Neo 2T';
        $role->price = 7000000;
        $role->describe = 'ĐẶC ĐIỂM NỔI BẬT CỦA REALME GT NEO 2T 5G
        Ra mắt GT Neo 2 cách đây chưa được bao lâu thì mới đây nhà sản xuất realme lại tiếp tục cho ra mắt mẫu rút gọn của sản phẩm này với tên gọi realme GT Neo 2T với một chút thay đổi về mặt màn hình, vi xử lý và pin. Vậy những thay đổi đó có thật sự khác biệt và realme GT Neo 2T vẫn tạo sức hút như những sản phẩm trước đó? Đặc biệt khi giá realme GT Neo 2T chỉ hơn 6 triệu thì sản phẩm này rất đáng để người dùng cân nhắc chọn mua. Sau đây mời các bạn cùng theo dõi đánh giá chi tiết.';
        $role->quantity = 119;
        $role->specifications = 'Thẻ SIM: 2 nano sim, 2 sóng online;
        Kiểu thiết kế: Khung nhựa, mặt lưng nhựa giả kính;
        Màn hình: 6.43 inches, Super AMOLED, 120Hz;
        Độ phân giải:	Full HD+, 1080 x 2400 pixels, tỷ lệ 20:9;
        CPU: Dimensity 1200 5G (6 nm) tám lõi;
        RAM: 8GB;
        Bộ nhớ/ Thẻ nhớ: 128/256GB, Không thẻ nhớ;
        Camera sau: 64 MP, f/1.8 +  8 MP +  2 MP;
        Camera trước:	16 MP, f/2.5, HDR, panorama, 1080p@30fps;
        Jack 3.5mm/ Loa: Có/ Loa kép Stereo;
        Pin: Li-Po 4500 mAh, Sạc nhanh 65W';
        $role->color = 'Trắng;Đen';
        $role->price_product = '7000000;7700000';
        $role->configuration = '8GB/128GB;8GB/256GB';
        $role->category_id  = 1;
        $role->user_id = 1;
        $role->image = 'storage/images/neo2t.jpg';
        $role->save();

        $role = new Product();
        $role->name = 'Samsung Galaxy Z Flip3';
        $role->price = 13000000;
        $role->describe = 'Đến chiếc Samsung Galaxy Z Flip3, Samsung đã mang đến một cái nhìn hoàn toàn mới về điện thoại gập với những nâng cấp tốt hơn và thực tế với nhu cầu sử dụng hơn. 
        Liệu với những thay đổi mới này họ có khiến cho người người dùng, chính chúng ta bước vào thời điểm dần phải tạm biệt những chiếc điện thoại màn hình phẳng không?';
        $role->quantity = 50;
        $role->specifications = 'Thẻ SIM:  2 SIM (1 nano sim, 1 esim);
        Màn hình:  6.7 inches, Foldable Dynamic AMOLED 2X, 120Hz, HDR10+;
        Độ phân giải:  Full HD+, 1080 x 2640 pixels;
        CPU:  Snapdragon 888 5G (5 nm);
        RAM:  8GB;
        Bộ nhớ/ Thẻ nhớ:  128GB/256GB;
        Camera sau:  12 MP, f/1.8 + 12 MP, f/2.2;
        Camera trước:  10 MP, f/2.4, 4K@30fps;
        Jack 3.5mm/ Loa:  Không/ Loa kép Stereo;
        Pin:  Li-Po 3300 mAh, Sạc nhanh 15W;
        Màu sắc:  Kem, Đen, Tím, Xanh Rêu';
        $role->color = 'Đen;Vàng;Xanh Cây';
        $role->price_product = '13000000;15600000';
        $role->configuration = '8GB/128GB;8GB/256GB';
        $role->category_id  = 3;
        $role->user_id = 1;
        $role->image = 'storage/images/zflip.jpg';
        $role->save();

        $role = new Product();
        $role->name = 'Xiaomi Redmi K50 Gaming';
        $role->price = 8000000;
        $role->describe = 'Trong tối ngày 16/02, Xiaomi đã chính thức ra mắt Xiaomi Redmi K50 Gaming Edition - mẫu smartphone được tối ưu dành riêng cho những game thủ. Vậy Redmi K50 Gaming Edition có gì mới? Redmi K50 Gaming Edition cấu hình ra sao? Redmi K50 Gaming Edition giá bao nhiêu? Hãy cùng mình điểm qua thông số cấu hình cũng như những điểm đặc biệt trên Redmi K50 Gaming Edition qua bài viết dưới đây nhé.';
        $role->quantity = 40;
        $role->specifications = 'Thẻ SIM: 2 Nano SIM, 2 sóng Online; Kiểu thiết kế: Khung viền kim loại, mặt lưng kính; Màn hình: 6.67 inches, OLED, 1 tỷ màu, 120Hz, HDR10+; Độ phân giải: Full HD+ 1080 x 2400 pixels, tỷ lệ 20:9; CPU: Snapdragon 8 Gen 1 (4 nm); RAM: 8/12GB; Bộ nhớ/ Thẻ nhớ: 128GB/256GB; Camera sau: 64 MP, f/1.7, 26mm (wide), 8 MP, 2 MP; Camera trước: 20MP, 1080p@30/60fps, 720p@120fps, HDR; Jack 3.5mm/ Loa: Không/ 4 loa Stereo tinh chỉnh bởi JBL; Pin: Li-Po 4700mAh, Sạc nhanh 120W';
        $role->color = 'Đen;Xanh Dương;Xám';
        $role->price_product = '8000000;9100000';
        $role->configuration = '8GB/128GB;12GB/128GB';
        $role->category_id  = 4;
        $role->user_id = 1;
        $role->image = 'storage/images/k50.jpg';
        $role->save();

        $role = new Product();
        $role->name = 'Realme Q5 Pro';
        $role->price = 6200000;
        $role->describe = 'Thiết kế: Ngoại hình của realme Q5 Pro: hiện đại, trẻ trung nhưng không kém phần sang trọng.
        Ngoại hình của realme Q5 Pro khá ấn tượng với thiết kế đẹp mắt, bắt trend, khung viền được vát phẳng, cứng cáp, đậm chất nam tính.';
        $role->quantity = 60;
        $role->specifications = 'Thẻ SIM:	2 nano sim, 2 sóng online;
        Kiểu thiết kế:	Khung viền nhựa, mặt lưng nhựa;
        Màn hình:  6.62 inches, AMOLED, 120Hz, HDR10+, 1300 nits;
        Độ phân giải:  FullHD+ 1080 x 2400 pixels, 20:9 ratio;
        CPU:  Snapdragon 870 5G (7 nm) 8 lõi;
        RAM:  6GB/8GB;
        Bộ nhớ/ Thẻ nhớ:  128/256GB;
        Camera sau:  64 MP, f/1.8, 25mm (wide), 8 MP, 2 MP;
        Camera trước:	 16 MP, f/2.5, 26mm (wide), HDR, panorama;
        Jack 3.5mm/ Loa:  Không/ Loa kép Stereo;
        Pin:	Li-Po 5000 mAh, Sạc nhanh 80W';
        $role->color = 'Vàng;Trắng';
        $role->price_product = '6200000;6700000';
        $role->configuration = '6GB/128GB;8GB/128GB';
        $role->category_id  = 1;
        $role->user_id = 1;
        $role->image = 'storage/images/q5.jpg';
        $role->save();

        $role = new Product();
        $role->name = 'iPhone 12';
        $role->price = 15000000;
        $role->describe = 'Kết hợp với chất liệu kim loại sang trọng, iPhone 12 đã gây được sự chú ý của người đối diện khi bạn cầm trên tay. Mặt lưng iPhone 12 được trang bị gia công bóng bẩy đầy cuốn hút, tuy nhiên khi cầm lâu bạn sẽ thấy thiết bị bám đầy dấu vân tay. Do đó bạn nên lau chùi thường xuyên để máy luôn sáng bóng nhé. Và thêm một điểm nữa mà chúng ta cần chú ý ở phần mặt lưng đó là cụm camera kép với chất lượng được nâng cấp lên một bậc.Cảm giác cầm nắm iPhone 12 rất sướng và khác lạ so với các thiết bị sở hữu các cạnh bên bo cong. Nhưng khi cầm lâu, bạn sẽ cảm thấy hơi đau tay một tí và nếu được, mình khuyên bạn nên trang bị thêm ốp lưng để cầm dễ chịu hơn.';
        $role->quantity = 100;
        $role->specifications = 'Thẻ SIM: 2 sim (nano + esim); Màn hình: 6.1 inches, Super Retina XDR OLED, HDR10, Dolby Vision, 1200 nits; Độ phân giải: 1170 x 2532 pixels, tỷ lệ 19.5:9; CPU: Apple A14 Bionic (5 nm); RAM: 4GB; Bộ nhớ/ Thẻ nhớ: 64GB, 128GB, 256GB; Camera sau: 12 MP, f/1.6, 26mm (wide), 1.4µm, dual pixel PDAF, OIS, 12 MP; Camera trước: 12 MP, f/2.2, HDR, 4K@60fps; Jack 3.5mm/ Loa: Không/ Loa kép Stereo; Pin: 2815 mAh, sạc nhanh 20W; Màu sắc: Đỏ, Xanh, Đen, Trắng';
        $role->color = 'Trắng;Đen;Xanh Dương;Tím;Xanh ';
        $role->price_product = '15000000;18200000;22000000';
        $role->configuration = '64GB;128GB;256GB';
        $role->category_id  = 2;
        $role->user_id = 1;
        $role->image = 'storage/images/12.jpg';
        $role->save();

        $role = new Product();
        $role->name = 'Iphone 14 pro max';
        $role->price = 39000000;
        $role->describe = 'Mô tả sản phẩm:
        iPhone 13 Pro Max chính hãng VN/A mới siêu lướt chính hãng đổi/ trả bảo hành, hàng xuất Viettel. Bộ sản phẩm chuẩn Fullbox gồm hộp chính hãng Việt Nam, thân máy, dây sạc USB C to Lightning, sách HDSD, que chọc sim. Sản phẩm đã kích hoạt/ chưa kích hoạt, bảo hành còn rất dài
        Số lượng có hạn, mời các bạn đặt hàng sớm tránh tình trạng hết hàng.';
        $role->quantity = 213;
        $role->specifications = 'Thẻ SIM:	Nano + eSim;
        Màn hình: LTPO Super Retina XDR OLED, 120Hz, HDR10, Dolby Vision
        6.7 inches, Full HD+ (1290 x 2796 pixels)
        Thủy tinh gốm chống xước, lớp phủ oleophobic
        Always-On display;
        Độ phân giải:	1284 x 2778 pixels, tỷ lệ 19.5:9;
        CPU:  Apple A16 Bionic (4 nm);
        RAM:  6GB;
        Bộ nhớ/ Thẻ nhớ:  128/256/512GB/1TB;
        Camera sau:  48 MP, f/1.5, 26mm (góc rộng), dual pixel PDAF, cảm biến OIS
        12 MP, f/1.8, 13mm, 120˚ (góc siêu rộng),dual pixel PDAF
        12 MP, f/2.8, 77mm (telephoto), PDAF, OIS, 3x optical zoom
        TOF 3D LiDAR (đo chiều sâu);
        Camera trước:	12 MP, f/2.2 (góc rộng), PDAF
        SL 3D (đo độ sâu/sinh trắc học);
        Quay phim: 4K@24/25/30/60fps, 1080p@25/30/60/120/240fps, 10-bit HDR, Dolby Vision HDR (up to 60fps), ProRes, Cinematic mode (4K@30fps), stereo sound rec;
        Jack 3.5mm/ Loa:	Không/ Loa kép Stereo;
        Pin: Sạc nhanh 20W, 50% in 30 min (Quảng cáo)
        USB Power Delivery 2.0
        Sạc không dây MagSafe 15W
        Sạc không dây từ tính Qi 7.5W;
        Màu sắc: Tím, Đen, Vàng, Trắng';
        $role->color = 'Trắng;Đen;Vàng;Tím ';
        $role->price_product = '29000000;33000000;38000000;45000000';
        $role->configuration = '128GB;256GB;512GB;1TB';
        $role->category_id  = 2;
        $role->user_id = 1;
        $role->image = 'storage/images/14prm.jpg';
        $role->save();

        $role = new Product();
        $role->name = 'Sam Sung Galaxy Note 20';
        $role->price = 800000;
        $role->describe = 'Tính năng bảo mật tiên tiến chắc chắn không thể thiếu trên Note 20, với công nghệ mở khóa bằng vân tay ngay trên màn hình giúp bạn mở khóa nhanh máy chỉ với một lần chạm vô cùng nhanh chóng và tiện lợi. còn có hiệu năng vượt trội với tốc độ xử lý mạnh mẽ, đáp ứng mọi thao tác tác vụ một cách nhanh chóng nhờ chip xử lý Exynos 990 8 nhân, RAM 8 GB/ROM 256 GB, người dùng có thể sử dụng nhiều tác vụ cùng lúc một cách dễ dàng, mượt mà.';
        $role->quantity = 223;
        $role->specifications = 'Thẻ SIM:  2 Nano sim - 2 sóng online;
        Màn hình:  6.7 inches, Super AMOLED Plus, HDR10+;
        Độ phân giải:  FullHD+ 1080 x 2400 pixels;
        CPU:  Exynos 990 (7 nm+) 8 lõi;
        RAM:  8GB;
        Bộ nhớ/ Thẻ nhớ:  256GB;
        Camera sau:  12 MP, f/1.8, 26mm (wide), 1/1.76", 1.8µm, Dual Pixel PDAF, OIS - 64MP - 12MP;
        Camera trước:  10 MP, f/2.2, 26mm (wide), 1/3.2", 1.22µm, Dual Pixel PDAF;
        Jack 3.5mm/ Loa:  Không/ Loa kép Stereo tinh chỉnh bởi AKG;
        Pin:  Li-Ion 4300 mAh, Sạc nhanh 25W;
        Màu sắc:  Xám, Xanh, Đỏ, Đồng';
        $role->color = 'Xanh Cây';
        $role->price_product = '12900000';
        $role->configuration = '8GB/256GB';
        $role->category_id  = 3;
        $role->user_id = 1;
        $role->image = 'storage/images/note20.jpg';
        $role->save();

        $role = new Product();
        $role->name = 'Xiaomi Black Shark 5 Pro';
        $role->price = 15400000;
        $role->describe = 'thiết kế mang đậm hơi hướng của sự mạnh mẽ và nam tính với hai lựa chọn đen và trắng. Mặt sau của máy làm bằng kim loại nhám và họa tiết được thiết kế một cách tỉ mỉ. Được kết hợp từ hai mặt kính với nhau, kèm theo đó là logo hình chữ S được lồng ghép vào những nét đậm nhạt sắc sảo mang đến cho điện thoại cảm giác vô cùng chất chơi.';
        $role->quantity = 223;
        $role->specifications = 'Thẻ SIM:	2 nano sim, 2 sóng online;
        Màn hình: 6.67 inches, OLED, 1B colors, 144Hz, HDR10+;
        Độ phân giải:	FulHD+ 1080 x 2400 pixels, 20:9 ratio;
        CPU:  Qualcomm SM8450 Snapdragon 8 Gen 1 (4 nm);
        RAM:  8GB/12GB/16GB;
        Bộ nhớ/ Thẻ nhớ:  256GB/521GB;
        Camera sau:  108 MP, f/1.8 + 13 MP, f/2.4 + 5 MP, f/2.4;
        Camera trước:	 16 MP, HDR, 1080p@30fps;
        Jack 3.5mm/ Loa:  Không/ Loa kép Stereo;
        Pin:	Li-Po 4650 mAh, Fast charging 120W;
        Màu sắc:	Trắng, Đen';
        $role->color = 'Đen;Trắng';
        $role->price_product = '15400000;16300000';
        $role->configuration = '8GB/256GB;12GB/256GB';
        $role->category_id  = 4;
        $role->user_id = 1;
        $role->image = 'storage/images/bls5.jpg';
        $role->save();
    }
}
