<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    private function abortIfNotAdmin()
    {
        if (!\Illuminate\Support\Facades\Auth::check() || \Illuminate\Support\Facades\Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập!');
        }
    }

    public function index()
    {
        $this->abortIfNotAdmin();
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        $this->abortIfNotAdmin();
        return view('admin.users.create');
    }
    public function store(Request $request)
    {
        $this->abortIfNotAdmin();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('admin.users.index')->with('success', 'Tạo user thành công!');
    }
    public function edit(User $user)
    {
        $this->abortIfNotAdmin();
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $this->abortIfNotAdmin();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'Cập nhật user thành công!');
    }

    public function destroy(User $user)
    {
        $this->abortIfNotAdmin();
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Xóa user thành công!');
    }
    public function getUserWatchlist($id)
{
    $this->abortIfNotAdmin();
    $user = \App\Models\User::findOrFail($id);
    $watchlist = $user->watchlist;
    if (is_string($watchlist)) {
        $watchlist = json_decode($watchlist, true);
    }
    return response()->json($watchlist ?? []);
}
public function updateWatchlist(Request $request)
{
    $user = $request->user();
    $watchlist = $request->input('watchlist', []);
    // Nếu là chuỗi JSON thì decode ra mảng
    if (is_string($watchlist)) {
        $watchlist = json_decode($watchlist, true);
    }
    $user->watchlist = $watchlist;
    $user->save();
    return response()->json(['success' => true]);
}
}
