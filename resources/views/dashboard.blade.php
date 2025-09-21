@extends('layouts.app')
@section('content')
<div class="min-h-screen w-full bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 flex flex-col">
    <div class="flex-1 flex flex-col items-center justify-center py-10">
        <div class="w-full max-w-4xl bg-white bg-opacity-90 rounded-2xl shadow-xl p-10 flex flex-col items-center">
            <h2 class="text-4xl font-extrabold mb-8 text-center text-blue-700 drop-shadow">Top 10 Coin Vốn Hóa Lớn</h2>
            <div class="w-full mb-4 flex justify-end">
                <button onclick="showWatchlist()" class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-4 py-2 rounded-lg font-semibold shadow hover:scale-105 transition">Xem Watchlist</button>
            </div>
            <div id="coin-list" class="w-full flex flex-col gap-4"></div>
        </div>
    </div>
    <div id="watchlist-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative animate-fadeIn">
            <button onclick="closeWatchlist()" class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-2xl font-bold">&times;</button>
            <h3 class="text-xl font-bold mb-4 text-center text-blue-700">Watchlist của bạn</h3>
            <div id="watchlist-content" class="flex flex-col gap-3"></div>
        </div>
    </div>
    <div id="chart-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative animate-fadeIn">
            <button onclick="closeChartModal()" class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-2xl font-bold">&times;</button>
            <h3 id="chart-title" class="text-xl font-bold mb-4 text-center text-blue-700"></h3>
            <canvas id="price-chart" height="120"></canvas>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Watchlist logic (đồng bộ với DB qua API)
let WATCHLIST = [];
async function fetchWatchlist() {
    const res = await fetch('/api/watchlist');
    WATCHLIST = await res.json();
}
async function saveWatchlist() {
    await fetch('/api/watchlist', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ watchlist: WATCHLIST })
    });
}
function isInWatchlist(id) {
    return WATCHLIST.includes(id);
}
async function addToWatchlist(id) {
    if (!WATCHLIST.includes(id)) {
        WATCHLIST.push(id);
        await saveWatchlist();
        renderCoins();
    }
}
async function removeFromWatchlist(id) {
    WATCHLIST = WATCHLIST.filter(s => s !== id);
    await saveWatchlist();
    renderCoins();
    renderWatchlist();
}

// Fetch top 10 coins from CoinGecko
let COINS = [];
async function fetchCoins() {
    const url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=10&page=1';
    const res = await fetch(url);
    COINS = await res.json();
    await fetchWatchlist();
    renderCoins();
}

function renderCoins() {
    const container = document.getElementById('coin-list');
    container.innerHTML = '';
    if (!COINS.length) {
        container.innerHTML = '<div class="text-center text-gray-500">Đang tải dữ liệu...</div>';
        return;
    }
    COINS.forEach(coin => {
        const inWatch = isInWatchlist(coin.id);
        const div = document.createElement('div');
        div.className = 'flex items-center justify-between bg-white bg-opacity-80 rounded-xl shadow p-4 hover:bg-blue-50 transition';
        div.innerHTML = `
            <div class="flex items-center gap-4 cursor-pointer" onclick="showChartModal('${coin.id}', '${coin.name}')">
                <img src="${coin.image}" alt="${coin.symbol}" class="w-12 h-12 rounded-full border bg-white" />
                <div>
                    <div class="font-bold text-lg text-blue-700">${coin.name} <span class="uppercase text-gray-500">(${coin.symbol})</span></div>
                    <div class="text-gray-600 text-sm">Giá: <span class="font-semibold text-green-700">$${coin.current_price.toLocaleString()}</span></div>
                    <div class="text-gray-600 text-sm">Vốn hóa: <span class="font-semibold">$${coin.market_cap.toLocaleString()}</span></div>
                    <div class="text-gray-600 text-sm">KL 24h: <span class="font-semibold">$${coin.total_volume.toLocaleString()}</span></div>
                    <div class="text-gray-600 text-sm">Thay đổi 24h: <span class="font-semibold ${coin.price_change_percentage_24h >= 0 ? 'text-green-600' : 'text-red-600'}">${coin.price_change_percentage_24h.toFixed(2)}%</span></div>
                </div>
            </div>
            <button onclick="event.stopPropagation();${inWatch ? `removeFromWatchlistHandler('${coin.id}')` : `addToWatchlistHandler('${coin.id}')`}" class="${inWatch ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600'} text-white px-4 py-2 rounded-lg font-semibold shadow transition">
                ${inWatch ? 'Bỏ Watchlist' : 'Thêm vào Watchlist'}
            </button>
        `;
        container.appendChild(div);
    });
}

// Handler để gọi async từ onclick
function addToWatchlistHandler(id) { addToWatchlist(id); }
function removeFromWatchlistHandler(id) { removeFromWatchlist(id); }


function showWatchlist() {
    document.getElementById('watchlist-modal').classList.remove('hidden');
    renderWatchlist();
}
function closeWatchlist() {
    document.getElementById('watchlist-modal').classList.add('hidden');
}
function renderWatchlist() {
    const content = document.getElementById('watchlist-content');
    const list = WATCHLIST;
    content.innerHTML = '';
    if (!list.length) {
        content.innerHTML = '<div class="text-gray-500 text-center">Chưa có coin nào trong watchlist.</div>';
        return;
    }
    list.forEach(id => {
        const coin = COINS.find(c => c.id === id);
        if (!coin) return;
        const div = document.createElement('div');
        div.className = 'flex items-center justify-between bg-gray-100 rounded-xl p-3';
        div.innerHTML = `
            <div class="flex items-center gap-3">
                <img src="${coin.image}" alt="${coin.symbol}" class="w-8 h-8 rounded-full border bg-white" />
                <span class="font-bold text-blue-700">${coin.symbol.toUpperCase()}</span>
                <span class="text-gray-600 text-sm">${coin.name}</span>
            </div>
            <button onclick="removeFromWatchlistHandler('${coin.id}')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded font-semibold">Bỏ</button>
        `;
        content.appendChild(div);
    });
}

// Chart modal logic
let chartInstance = null;
async function showChartModal(coinId, coinName) {
    document.getElementById('chart-title').innerText = `Biểu đồ giá 7 ngày: ${coinName}`;
    document.getElementById('chart-modal').classList.remove('hidden');
    const url = `https://api.coingecko.com/api/v3/coins/${coinId}/market_chart?vs_currency=usd&days=7`;
    const res = await fetch(url);
    const data = await res.json();
    const prices = data.prices;
    const labels = prices.map(p => {
        const d = new Date(p[0]);
        return `${d.getDate()}/${d.getMonth()+1}`;
    });
    const values = prices.map(p => p[1]);
    const ctx = document.getElementById('price-chart').getContext('2d');
    if (chartInstance) chartInstance.destroy();
    chartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Giá USD',
                data: values,
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { display: true },
                y: { display: true }
            }
        }
    });
}
function closeChartModal() {
    document.getElementById('chart-modal').classList.add('hidden');
}

window.onload = fetchCoins;
</script>





</script>
@endsection
