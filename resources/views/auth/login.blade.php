@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Đăng nhập Monad Wallet</h2>
    @if($errors->any())
        <div class="mb-4 text-red-600">{{$errors->first()}}</div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <label for="email" class="block mb-1">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" required autofocus>
        </div>
        <div class="mb-4">
            <label for="password" class="block mb-1">Mật khẩu</label>
            <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Đăng nhập</button>
    </form>
    <div class="mt-4 text-center">
        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Chưa có tài khoản? Đăng ký</a>
    </div>
</div>
@endsection
