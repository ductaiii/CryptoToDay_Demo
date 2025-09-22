<div align="center">
	<h1>Crypto Today</h1>
	<p><b>Demo web for managing & tracking the crypto market, built with Laravel + CoinGecko API</b></p>
</div>

## 🚀 Main Features

- User registration, login, and role-based access (user/admin)
- Dashboard:
	- Display top 10 coins by market cap (realtime data from CoinGecko)
	- View 7-day price chart for each coin (Chart.js)
	- Add/remove coins to personal Watchlist (saved in DB, backend synced)
- Watchlist page:
	- Quickly view your saved coins
- Admin page:
	- User management (CRUD)
	- View each user's Watchlist directly
- Responsive, modern UI, easy to use

## 🛠️ Technology Stack

- Laravel 10 (PHP)
- Blade Template
- Tailwind CSS
- JavaScript (fetch API, Chart.js)
- CoinGecko API (market data)
- MySQL (or SQLite)

## ⚡ Quick Start

1. Clone the project:
	 ```bash
	 git clone https://github.com/ductaiii/CryptoToDay_Demo.git
	 cd CryptoToDay_Demo/monad-wallet
	 ```
2. Install dependencies:
	 ```bash
	 composer install
	 npm install && npm run build # if using frontend build
	 ```
3. Create `.env` file and configure database:
	 ```bash
	 cp .env.example .env
	 # edit DB_DATABASE, DB_USERNAME, DB_PASSWORD as needed
	 ```
4. Generate app key and migrate database:
	 ```bash
	 php artisan key:generate
	 php artisan migrate
	 ```
5. Run the server:
	 ```bash
	 php artisan serve
	 ```
6. Visit: http://127.0.0.1:8000

## 📚 API & Data Structure

- Watchlist sync via API:
	- `/api/watchlist` (user): GET/POST
	- `/admin/users/{id}/watchlist` (admin): GET
- Watchlist is stored as JSON in the `users` table

## 💡 Notes

- This is a demo project, does not store private keys, and does not perform real transactions.
- Coin data is fetched from CoinGecko, may be rate-limited if spammed.
- UI can be customized as needed.

---
<div align="center">Made with ❤️ by ductaiii</div>
