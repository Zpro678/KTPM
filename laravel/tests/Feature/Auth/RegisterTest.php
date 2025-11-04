<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\client; // Sửa: đổi từ Client sang client (lowercase)
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\Hash;

class RegisterTest extends TestCase
{
    use RefreshDatabase; // Tự động làm mới database sau mỗi test

    #[Test]
    public function test_khach_hang_co_the_dang_ky_voi_thong_tin_hop_le()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'Admin@1234',
            'password_confirmation' => 'Admin@1234',
        ];

        $response = $this->post('/register', $userData);
        $response->assertRedirect('/login'); // Đăng ký xong chuyển hướng về login
        $this->assertGuest('client'); // Kiểm tra chưa đăng nhập
        $this->assertDatabaseHas('users', [
            'email' => 'test@gmail.com',
        ]);
    }

    #[Test]
    public function test_khach_hang_khong_the_dang_ky_voi_email_da_ton_tai()
    {
        // 1. Tạo một client đã tồn tại
        client::factory()->create([ // Sửa: đổi từ Client sang client
            'email' => 'existing@gmail.com',
            'password' => bcrypt('Admin@1234'),
        ]);

        // 2. Thử đăng ký với email đó
        $userData = [
            'name' => 'New User',
            'email' => 'existing@gmail.com', // Email đã tồn tại
            'password' => 'Admin@1234',
            'password_confirmation' => 'Admin@1234',
        ];

        $response = $this->post('/register', $userData);

        // Kiểm tra lỗi validation cho trường email
        $response->assertSessionHasErrors('email');
        $this->assertGuest('client'); // Đảm bảo chưa đăng nhập
    }

    #[Test]
    public function test_khach_hang_khong_the_dang_ky_voi_mat_khau_khong_khop()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'Admin@1234',
            'password_confirmation' => 'WrongPassword@1234', // Mật khẩu không khớp
        ];

        $response = $this->post('/register', $userData);

        // Kiểm tra lỗi validation cho trường password (do 'confirmed' rule)
        $response->assertSessionHasErrors('password');
        $this->assertGuest('client');
    }

    #[Test]
    public function test_khach_hang_khong_the_dang_ky_voi_mat_khau_qua_ngan()
    {
        // Dựa theo yêu cầu: Mật khẩu 6-16 ký tự
        $userData = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'Abc12', // < 6 ký tự
            'password_confirmation' => 'Abc12',
        ];

        $response = $this->post('/register', $userData);

        $response->assertSessionHasErrors('password');
        $this->assertGuest('client');
    }

    #[Test]
    public function test_khach_hang_khong_the_dang_ky_voi_mat_khau_thieu_chu_hoa_hoac_so()
    {
        // Dựa theo yêu cầu: Phải có chữ hoa và số
        // (Giả sử bạn dùng Validation Rule như: 'min:6', 'max:16', 'regex:/[A-Z]/', 'regex:/[0-9]/')

        // TH1: Thiếu chữ hoa
        $userData_NoUpper = [
            'name' => 'Test User',
            'email' => 'test1@gmail.com',
            'password' => 'admin@1234',
            'password_confirmation' => 'admin@1234',
        ];
        
        $response1 = $this->post('/register', $userData_NoUpper);
        $response1->assertSessionHasErrors('password');

        // TH2: Thiếu số
        $userData_NoNumber = [
            'name' => 'Test User',
            'email' => 'test2@gmail.com',
            'password' => 'Admin@abc',
            'password_confirmation' => 'Admin@abc',
        ];

        $response2 = $this->post('/register', $userData_NoNumber);
        $response2->assertSessionHasErrors('password');

        $this->assertGuest('client');
    }

    #[Test]
    public function test_khach_hang_dang_ky_bo_trong_truong_thong_tin_se_bi_loi()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertGuest('client');
    }
}