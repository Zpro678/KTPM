<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
class LoginTest extends TestCase
{
    use RefreshDatabase; //tự đạo động làm mới database sau mỗi test

    #[Test]
    public function test_khach_hang_co_the_dang_nhap_voi_thong_tin_dung()
    {
        $client = Client::factory()->create([
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('Admin@1234'),
            'is_active' => 1,
        ]);

        $response = $this->post('/login', [
            'email' => 'admin2@gmail.com',
            'password' => 'Admin@1234',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($client, 'client');
    }

    #[Test]
    public function test_khach_hang_khong_the_dang_nhap_voi_mat_khau_sai()
    {
        $client = Client::factory()->create([
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('Admin@1234'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin2@gmail.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors(['password']);
        $this->assertGuest('client');
    }

    #[Test]
public function khach_hang_dang_nhap_voi_email_khong_ton_tai_se_bi_loi()
{
    // Không tạo client nào trong DB

    $response = $this->post('/login', [
        'email' => 'khongton@gmail.com',
        'password' => 'MatKhauNaoDo',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors('email');
    $this->assertGuest('client');
}
#[Test]
public function khach_hang_dang_nhap_bo_trong_truong_thong_tin_se_bi_loi()
{
    $response = $this->post('/login', [
        'email' => '',
        'password' => '',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['email', 'password']);
    $this->assertGuest('client');
}

}