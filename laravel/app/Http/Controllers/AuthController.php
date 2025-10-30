<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    //

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function index()
    {
        return view('home');
    }
  
       
public function login(Request $request)
{
    //  Kiểm tra dữ liệu đầu vào
    $request->validate([
        'email' => ['required', 'string'],
        'password' => ['required', 'string'],
    ], [
        'email.required' => 'Vui lòng nhập email.',
        'password.required' => 'Vui lòng nhập mật khẩu.',
    ]);

    // Tìm client theo email
    $client = Client::where('email', $request->email)->first();

    //  Nếu không tìm thấy email
    if (!$client) {
        return back()->withErrors([
            'email' => 'Email không tồn tại trong hệ thống.',
        ])->withInput();
    }

    // 4Kiểm tra mật khẩu (so sánh với hash trong DB)
    // if (!Hash::check($request->password, $client->password)) {
    //     return back()->withErrors([
    //         'password' => 'Mật khẩu không đúng.',
    //     ])->withInput();
    // }

    // Kiểm tra trạng thái tài khoản
    if ($client->is_active == 0) {
        return back()->withErrors([
            'email' => 'Tài khoản chưa được kích hoạt.',
        ])->withInput();
    }

    // Đăng nhập thủ công (lưu client vào session)
    Auth::login($client);

    // Chuyển hướng sau khi đăng nhập
    return redirect()->intended('home');
}


        public function logout()
        {
            client::logout();
            return redirect()->route('login');
        }
    
}
