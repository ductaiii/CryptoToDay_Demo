<div align="center">
	<h1>Crypto Today</h1>
	<p><b>Demo web quản lý & theo dõi thị trường Crypto, xây dựng với Laravel + CoinGecko API</b></p>
</div>

## 🚀 Tính năng chính

- Đăng ký, đăng nhập, phân quyền user (user/admin)
- Trang Dashboard:
	- Hiển thị top 10 coin vốn hóa lớn (dữ liệu realtime từ CoinGecko)
	- Xem biểu đồ giá 7 ngày từng coin (Chart.js)
	- Thêm/bỏ coin vào Watchlist cá nhân (lưu DB, đồng bộ backend)
- Trang Watchlist:
	- Xem nhanh các coin đã lưu
- Trang Admin:
	- Quản lý user (CRUD)
	- Xem trực tiếp Watchlist của từng user
- Responsive UI, hiện đại, dễ sử dụng

## 🛠️ Công nghệ sử dụng

- Laravel 10 (PHP)
- Blade Template
- Tailwind CSS
- JavaScript (fetch API, Chart.js)
- CoinGecko API (market data)
- MySQL (hoặc SQLite)

## ⚡ Hướng dẫn cài đặt nhanh

1. Clone project:
	 ```bash
	 git clone https://github.com/ductaiii/CryptoToDay_Demo.git
	 cd CryptoToDay_Demo/monad-wallet
	 ```
2. Cài đặt package:
	 ```bash
	 composer install
	 npm install && npm run build # nếu dùng frontend build
	 ```
3. Tạo file `.env` và cấu hình database:
	 ```bash
	 cp .env.example .env
	 # sửa DB_DATABASE, DB_USERNAME, DB_PASSWORD cho phù hợp
	 ```
4. Tạo key và migrate database:
	 ```bash
	 php artisan key:generate
	 php artisan migrate
	 ```
5. Chạy server:
	 ```bash
	 php artisan serve
	 ```
6. Truy cập: http://127.0.0.1:8000

## 📝 Demo tài khoản

- Tài khoản admin: `taicutm@gmail.com` / mật khẩu bạn tự tạo khi seed hoặc đăng ký
- Tài khoản user: `luubi@gmail.com`, `tonggiang@gmail.com` ...

## 📚 API & cấu trúc dữ liệu

- Đồng bộ Watchlist qua API:
	- `/api/watchlist` (user): GET/POST
	- `/admin/users/{id}/watchlist` (admin): GET
- Watchlist lưu dạng JSON trong bảng `users`

## 💡 Ghi chú

- Dự án chỉ demo, không lưu private key, không thực hiện giao dịch thật.
- Dữ liệu coin lấy từ CoinGecko, có thể bị giới hạn request nếu spam.
- UI có thể tuỳ chỉnh thêm theo nhu cầu.

---
<div align="center">Made with ❤️ by ductaiii & Copilot</div>
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
