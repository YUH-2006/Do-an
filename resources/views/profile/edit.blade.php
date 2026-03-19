@extends('layouts.app')

@section('content')
    <div style="max-width: 720px; margin: 20px auto; padding: 20px; background:#fff; border-radius:8px;">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
            <h2 style="margin:0;">Chỉnh sửa profile</h2>
            <a href="/products" style="text-decoration:none; padding:8px 10px; border:1px solid #ddd; border-radius:6px;">← Quay lại</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success" style="margin-top:14px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-top:14px;">
                <div class="fw-semibold mb-1">Vui lòng kiểm tra lại:</div>
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="display:flex; gap:18px; align-items:flex-start; flex-wrap:wrap; margin-top:14px;">
            <div style="min-width: 170px;">
                <div style="font-weight:600; margin-bottom:8px;">Ảnh hiện tại</div>
                @php
                    $avatarUrl = $user->avatar ? asset('storage/' . $user->avatar) : asset('images/no-image.png');
                @endphp
                <img
                    src="{{ $avatarUrl }}"
                    alt="Avatar"
                    style="width: 140px; height: 140px; object-fit: cover; border-radius:12px; border:1px solid #eee;"
                />
            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" style="flex:1; min-width: 280px;">
                @csrf

                <div style="margin-bottom: 12px;">
                    <label style="display:block; margin-bottom:6px; font-weight:600;">Tên</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
                    @error('name') <div style="color:#dc3545; margin-top:6px;">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom: 12px;">
                    <label style="display:block; margin-bottom:6px; font-weight:600;">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
                    @error('email') <div style="color:#dc3545; margin-top:6px;">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom: 12px;">
                    <label style="display:block; margin-bottom:6px; font-weight:600;">Số điện thoại</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;" placeholder="Tùy chọn">
                    @error('phone') <div style="color:#dc3545; margin-top:6px;">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom: 12px;">
                    <label style="display:block; margin-bottom:6px; font-weight:600;">Địa chỉ</label>
                    <input type="text" name="address" value="{{ old('address', $user->address) }}"
                        style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;" placeholder="Tùy chọn">
                    @error('address') <div style="color:#dc3545; margin-top:6px;">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom: 12px;">
                    <label style="display:block; margin-bottom:6px; font-weight:600;">Bio</label>
                    <textarea name="bio" rows="4"
                        style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;" placeholder="Tùy chọn">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio') <div style="color:#dc3545; margin-top:6px;">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom: 12px;">
                    <label style="display:block; margin-bottom:6px; font-weight:600;">Avatar (upload)</label>
                    <input type="file" name="avatar" accept="image/*"
                        style="width:100%; padding:8px; border:1px dashed #ddd; border-radius:6px;">
                    <div style="color:#6c757d; font-size: 13px; margin-top:6px;">Chỉ hỗ trợ JPG/PNG/WebP, kích thước tối đa 4MB.</div>
                    @error('avatar') <div style="color:#dc3545; margin-top:6px;">{{ $message }}</div> @enderror
                </div>

                <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <button type="submit" style="padding:10px 14px; background:#0d6efd; color:#fff; border:none; border-radius:6px; cursor:pointer;">
                        Lưu thay đổi
                    </button>
                    <a href="/products" style="padding:10px 14px; border:1px solid #ddd; border-radius:6px; text-decoration:none; color:#333;">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection