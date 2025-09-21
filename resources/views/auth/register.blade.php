@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Đăng ký Monad Wallet</h2>
    @if($errors->any())
        <div class="mb-4 text-red-600">{{$errors->first()}}</div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block mb-1">Tên</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" required autofocus>
        </div>
        <div class="mb-4">
            <label for="email" class="block mb-1">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block mb-1">Mật khẩu</label>
            <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block mb-1">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded px-3 py-2" required>
        </div>
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Đăng ký</button>
    </form>
    <div class="mt-4 text-center">
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Đã có tài khoản? Đăng nhập</a>
    </div>
</div>
@endsection
