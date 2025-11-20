# Coffee Shop Admin Template

Template quản lý quán cà phê được xây dựng bằng Tailwind CSS theo mô hình MVC để tích hợp với PHP.

## Tính năng

- ✅ Dashboard với biểu đồ thống kê (Chart.js)
- ✅ Trang danh sách sản phẩm dạng bảng
- ✅ Trang form thêm/sửa sản phẩm
- ✅ Trang đăng nhập
- ✅ Trang đăng ký
- ✅ Responsive design với Tailwind CSS
- ✅ Sidebar navigation
- ✅ Font Awesome icons

## Cấu trúc thư mục

```
workshop_github/
├── index.php                 # Entry point, router
├── controllers/              # Controllers (MVC)
│   ├── DashboardController.php
│   ├── ProductController.php
│   └── AuthController.php
├── models/                   # Models (để tích hợp với database)
├── views/                    # Views
│   ├── layouts/              # Layout templates
│   │   ├── base.php          # Main layout with sidebar
│   │   └── auth.php          # Auth layout (login, register)
│   ├── dashboard/            # Dashboard views
│   │   └── index.php
│   ├── products/             # Product views
│   │   ├── index.php         # List view
│   │   └── form.php          # Add/Edit form
│   └── auth/                 # Authentication views
│       ├── login.php
│       └── register.php
└── public/                   # Public assets
    ├── css/
    ├── js/
    └── assets/
```

## Cài đặt

1. Clone repository này
2. Đặt project trong thư mục web server (htdocs, www, v.v.)
3. Truy cập qua browser: `http://localhost/workshop_github/`

## Sử dụng

### Các trang có sẵn:

- **Dashboard**: `index.php?page=dashboard` (hoặc chỉ `index.php`)
- **Danh sách sản phẩm**: `index.php?page=products`
- **Thêm sản phẩm**: `index.php?page=product-form`
- **Đăng nhập**: `index.php?page=login`
- **Đăng ký**: `index.php?page=register`

### Mở rộng template:

1. **Thêm Model mới**: Tạo file trong thư mục `models/`
2. **Thêm Controller mới**: Tạo file trong thư mục `controllers/`
3. **Thêm View mới**: Tạo file trong thư mục `views/`
4. **Thêm route mới**: Cập nhật `index.php`

## Công nghệ sử dụng

- **PHP**: Backend logic
- **Tailwind CSS**: Styling (CDN)
- **Chart.js**: Biểu đồ thống kê
- **Font Awesome**: Icons
- **MVC Pattern**: Kiến trúc ứng dụng

## Tùy chỉnh

### Thay đổi màu chủ đạo:

Màu mặc định là `indigo`. Để thay đổi, tìm và thay thế các class Tailwind như:
- `bg-indigo-600` → `bg-blue-600`
- `text-indigo-600` → `text-blue-600`
- v.v.

### Kết nối Database:

1. Tạo file `config/database.php` để cấu hình kết nối
2. Tạo models trong thư mục `models/` để xử lý dữ liệu
3. Cập nhật controllers để sử dụng models thay vì dữ liệu mẫu

## License

MIT