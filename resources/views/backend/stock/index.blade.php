@extends('backend.layouts.app')

@section('title', 'Quản lý Tồn kho')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Quản lý Tồn kho</h5>
                        </div>
                        <div class="ibox-content">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form method="GET" class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="Tìm sản phẩm..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="low_stock" id="low_stock" {{ request('low_stock') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="low_stock">
                                            Chỉ hiện tồn kho thấp
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="low_stock_threshold" class="form-control" placeholder="Ngưỡng" value="{{ request('low_stock_threshold', 10) }}" min="0">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Lọc</button>
                                    <a href="{{ route('backend.stock.index') }}" class="btn btn-secondary"><i class="fa fa-refresh"></i> Reset</a>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Danh mục</th>
                                            <th>Giá</th>
                                            <th>Tồn kho</th>
                                            <th>Trạng thái</th>
                                            <th>Cập nhật tồn kho</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($products as $p)
                                            <tr>
                                                <td>{{ $p->id }}</td>
                                                <td>{{ $p->ten_sanpham }}</td>
                                                <td>{{ $p->category->ten_danhmuc ?? '' }}</td>
                                                <td>{{ number_format($p->giasp, 0, ',', '.') }} VNĐ</td>
                                                <td>
                                                    @if($p->stock <= 10)
                                                        <span class="badge bg-danger">{{ $p->stock }}</span>
                                                    @elseif($p->stock <= 50)
                                                        <span class="badge bg-warning">{{ $p->stock }}</span>
                                                    @else
                                                        <span class="badge bg-success">{{ $p->stock }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $p->status ? 'Hiển thị' : 'Ẩn' }}</td>
                                                <td>
                                                    <form action="{{ route('backend.stock.update', $p->id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="number" name="stock" value="{{ $p->stock }}" class="form-control form-control-sm me-2" min="0" style="width: 80px;" required>
                                                        <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Không có sản phẩm nào.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
