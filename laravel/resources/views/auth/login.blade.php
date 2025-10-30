<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #6fb1fc, #4364f7, #0052d4);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            border-radius: 15px;
        }
        #togglePassword:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>

    <form id="loginForm" method="POST" action="{{ route('auth.login') }}" 
          class="container p-4 bg-white col-md-4">
        @csrf
        <h3 class="text-center mb-4 fw-bold text-primary">Đăng nhập</h3>
        <!-- EMAIL -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-control"
                placeholder="Nhập email của bạn"
                value="{{ old('email') }}"
                required
                maxlength="255"
                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
            >
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- PASSWORD -->
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Mật khẩu</label>
            <div class="input-group">
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="form-control"
                    placeholder="Nhập mật khẩu"
                    required
                    minlength="6"
                    maxlength="50"
                >
                <button type="button" class="btn btn-outline-secondary" id="togglePassword" title="Hiện/Ẩn mật khẩu">
                    👁
                </button>
            </div>
            <div id="passwordError" class="text-danger small mt-1"></div>
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- NÚT ĐĂNG NHẬP -->
        <button type="submit" class="btn btn-primary w-100 fw-semibold">Đăng Nhập</button>

        <div class="text-center mt-3">
            <a href="{{ route('auth.register') }}" class="btn btn-outline-primary w-100 fw-semibold">
                Chưa có tài khoản? Đăng ký
            </a>
        </div>

        <!-- THÔNG BÁO CHUNG (nếu có lỗi đăng nhập) -->
        @if ($errors->has('email'))
            <div class="alert alert-danger mt-3 text-center">
                {{ $errors->first('email') }}
            </div>
        @endif
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script kiểm tra password -->
    <script>
    const form = document.getElementById('loginForm');
    const passwordInput = document.getElementById('password');
    const errorDiv = document.getElementById('passwordError');
    const toggleBtn = document.getElementById('togglePassword');

    // 👁 Hiện/ẩn mật khẩu
    toggleBtn.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    });

    // Kiểm tra độ mạnh mật khẩu
    form.addEventListener('submit', function(e) {
        const password = passwordInput.value;
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/;

        errorDiv.textContent = '';

        if (password.trim() === '') {
            e.preventDefault();
            errorDiv.textContent = 'Mật khẩu không được để trống.';
        } else if (password.length < 6) {
            e.preventDefault();
            errorDiv.textContent = 'Mật khẩu tối thiểu 6 ký tự.';
        } else if (!regex.test(password)) {
            e.preventDefault();
            errorDiv.textContent = 'Mật khẩu phải có chữ hoa, chữ thường, số và ký tự đặc biệt.';
        }
    });
    </script>

</body>
</html>
