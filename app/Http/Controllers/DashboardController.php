<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Trang dashboard chỉ hiển thị danh sách coin, không còn ví Monad
        return view('dashboard');
    }

    // API: Lấy watchlist của user hiện tại
    public function getWatchlist(Request $request)
    {
        $user = $request->user();
        return response()->json($user->watchlist ?? []);
    }

    // API: Cập nhật watchlist cho user hiện tại
    public function updateWatchlist(Request $request)
    {
        $user = $request->user();
        $watchlist = $request->input('watchlist', []);
        $user->watchlist = $watchlist;
        $user->save();
        return response()->json(['success' => true]);
    }
}
