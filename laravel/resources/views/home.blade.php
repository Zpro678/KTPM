<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop Bike - Trang Chủ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .hero {
      background: url('https://images.unsplash.com/photo-1504215680853-026ed2a45def') center/cover no-repeat;
      height: 70vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-shadow: 2px 2px 10px rgba(0,0,0,0.7);
    }
    .hero h1 {
      font-size: 4rem;
      font-weight: 700;
    }
    .product-card {
      transition: transform .3s, box-shadow .3s;
    }
    .product-card:hover {
      transform: scale(1.05);
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">🏍️ ShopBike</a>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a href="#" class="nav-link active">Trang Chủ</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Sản Phẩm</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Liên Hệ</a></li>
          <li class="nav-item"><a href="/login" class="btn btn-warning btn-sm ms-2">Đăng Xuất</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero text-center">
    <div>
      <h1>Chào mừng đến ShopBike!</h1>
      <p>Phụ kiện xe, đồ bảo hộ, và nhiều hơn nữa 🚴‍♂️</p>
      <a href="#" class="btn btn-warning btn-lg mt-3">Khám phá ngay</a>
    </div>
  </section>

  <!-- Products -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Sản phẩm nổi bật</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card product-card">
            <img src="https://images.unsplash.com/photo-1518655048521-f130df041f66" class="card-img-top" alt="Sản phẩm">
            <div class="card-body text-center">
              <h5 class="card-title">Nón bảo hiểm X1</h5>
              <p class="card-text text-muted">Giá: 450.000đ</p>
              <a href="#" class="btn btn-outline-primary">Xem chi tiết</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card product-card">
          <img src="https://images.unsplash.com/photo-1606813902912-8c6e5b32f1b3?auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Găng tay mô tô">


            <div class="card-body text-center">
              <h5 class="card-title">Găng tay Racing</h5>
              <p class="card-text text-muted">Giá: 220.000đ</p>
              <a href="#" class="btn btn-outline-primary">Xem chi tiết</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card product-card">
            <img src="https://images.unsplash.com/photo-1502877338535-766e1452684a" class="card-img-top" alt="Sản phẩm">
            <div class="card-body text-center">
              <h5 class="card-title">Giày đi phượt</h5>
              <p class="card-text text-muted">Giá: 890.000đ</p>
              <a href="#" class="btn btn-outline-primary">Xem chi tiết</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-4">
    <p>&copy; 2025 ShopBike | Thiết kế bởi Minh Hiếu 💻</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
