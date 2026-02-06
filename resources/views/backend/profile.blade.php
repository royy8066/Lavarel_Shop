@extends('backend.layouts.app')

@section('title', 'Profile')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Thông tin cá nhân</h5>
                </div>
                <div class="ibox-content">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('frontend.update') }}">
                        @csrf
                        <div class="form-group">
                            <label>Họ và tên</label>
                            <input type="text" name="fullname" class="form-control" value="{{ Auth::user()->fullname ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" name="sdt" class="form-control" value="{{ Auth::user()->sdt ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <textarea name="diachi" class="form-control">{{ Auth::user()->diachi ?? '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
