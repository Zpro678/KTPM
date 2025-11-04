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
       
        $client = Client::GetEmailUser($request);
       
        if (!$client) {
            return back()->withErrors(['email' => 'Email không tồn tại.']);
        }
        
        //!Hash::check($request->password, $client->password) ||

        if (!Hash::check($request->password, $client->password) || !(md5($request->password) === $client->password)) {
            return back()->withErrors(['password' => 'Mật khẩu không đúng.']);
        } 

        if ($client->is_active == 0) {
            return back()->withErrors(['email' => 'Tài khoản chưa được kích hoạt.']);
        }

        // ✅ đăng nhập bằng guard client
        Auth::guard('client')->login($client);

        return redirect()->intended('/home');
    }

        public function logout()
        {
            client::logout();
            return redirect()->route('login');
        }
    
     public function showRegister()
    {
        return view('auth.register'); 
    }

    public function register(Request $request)
    {
        // Validate
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:6',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
            ]
        ], [
            'password.regex' => 'Mật khẩu cần chữ hoa, chữ thường, số và ký tự đặc biệt.'
        ]);

        $hashPassword = md5($request->password);
        // Lưu vào database
        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashPassword // không lưu plain text!
        ]);


        // Redirect sau khi đăng ký thành công
        return redirect()->route('auth.login')->with('success', 'Đăng ký thành công!');
    }
}
