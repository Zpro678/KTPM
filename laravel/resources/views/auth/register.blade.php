<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
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
        #togglePassword:hover, #toggleConfirmPassword:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>

    <form id="registerForm" method="POST" action="{{ route('auth.register') }}" class="container p-4 bg-white col-md-4">
        @csrf
        <h3 class="text-center mb-4 fw-bold text-primary">Đăng ký tài khoản</h3>

        <!-- NAME -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Họ và tên</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập họ tên" value="{{ old('name') }}" required maxlength="255">
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- EMAIL -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Nhập email" value="{{ old('email') }}" required maxlength="255">
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- PASSWORD -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Mật khẩu</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" required minlength="6" maxlength="50">
            <div id="passwordError" class="text-danger small mt-1"></div>
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- CONFIRM PASSWORD -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" required>
            <div id="confirmError" class="text-danger small mt-1"></div>
        </div>
        <!-- <div class="mb-3">
            <label class="form-label fw-semibold">Xác nhận mật khẩu</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" required>
                <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">👁</button>
            </div>
            <div id="confirmError" class="text-danger small mt-1"></div>
        </div> -->

        <button type="submit" class="btn btn-primary w-100 fw-semibold">Đăng ký</button>

        <div class="text-center mt-3">
            <a href="{{ route('auth.login') }}" class="btn btn-outline-secondary w-100 fw-semibold">
                Đã có tài khoản? Đăng nhập
            </a>
        </div>

        @if(session('error'))
            <div class="alert alert-danger mt-3 text-center">{{ session('error') }}</div>
        @endif
    </form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const form = document.getElementById('registerForm');
const passwordInput = document.getElementById('password');
const confirmInput = document.getElementById('password_confirmation');
const errorDiv = document.getElementById('passwordError');
const errorConfirm = document.getElementById('confirmError');
const toggleBtn = document.getElementById('togglePassword');
const toggleConfirmBtn = document.getElementById('toggleConfirmPassword');

// Validation
form.addEventListener('submit', function(e) {
    const password = passwordInput.value;
    const confirm = confirmInput.value;
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/;

    errorDiv.textContent = '';
    errorConfirm.textContent = '';

    if (!regex.test(password)) {
        e.preventDefault();
        errorDiv.textContent = 'Mật khẩu cần chữ hoa, chữ thường, số và ký tự đặc biệt.';
    }

    if (password !== confirm) {
        e.preventDefault();
        errorConfirm.textContent = 'Mật khẩu xác nhận không khớp.';
    }
});
</script>

</body>
</html>
