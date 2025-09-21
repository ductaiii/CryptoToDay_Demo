@extends('layouts.app')
@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 py-8">
    <div class="w-4/5 max-w-6xl bg-white bg-opacity-90 rounded-2xl shadow-xl p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-blue-700">Quản lý User</h2>
            <a href="{{ route('admin.users.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">+ Thêm User</a>
        </div>
        @if(session('success'))
            <div class="mb-4 text-green-700">{{ session('success') }}</div>
        @endif
    <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Tên</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Role</th>
                    <th class="py-2 px-4 border-b">Watchlist</th>
                    <th class="py-2 px-4 border-b">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="text-center">
                    <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                    <td class="py-2 px-4 border-b" id="watchlist-{{ $user->id }}">
                        <span class="text-gray-400 italic">Đang tải...</span>
                    </td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:underline mr-2">Sửa</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    <!-- Không còn modal watchlist user -->
    </div>
</div>
<script>
@foreach($users as $user)
fetch(`/admin/users/{{ $user->id }}/watchlist`).then(res => res.json()).then(data => {
    const el = document.getElementById('watchlist-{{ $user->id }}');
    if (!data || !data.length) {
        el.innerHTML = '<span class="text-gray-400 italic">Không có</span>';
    } else {
        el.innerHTML = data.map(symbol => `<span class="inline-block bg-blue-100 text-blue-700 rounded px-2 py-1 m-1 text-xs font-semibold">${symbol}</span>`).join('');
    }
});
@endforeach
</script>
</div>
@endsection
