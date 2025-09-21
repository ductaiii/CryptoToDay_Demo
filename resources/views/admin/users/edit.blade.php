@extends('layouts.app')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 py-8">
    <div class="w-full max-w-md bg-white bg-opacity-90 rounded-2xl shadow-xl p-8">
        <h2 class="text-2xl font-bold text-blue-700 mb-6">Sửa User</h2>
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block mb-1">Tên</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Mật khẩu mới (bỏ qua nếu không đổi)</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Role</label>
                <select name="role" class="w-full border rounded px-3 py-2">
                    <option value="user" @if($user->role=='user') selected @endif>User</option>
                    <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Cập nhật</button>
        </form>
    </div>
</div>
@endsection
