@extends('backend.layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Danh sách sản phẩm</h5>
                    <div class="ibox-tools">
                        <a href="{{ route('backend.product.addsanpham') }}" class="btn btn-primary btn-xs">
                            <i class="fa fa-plus"></i> Thêm sản phẩm
                        </a>
                        <a href="{{ route('backend.stock.index') }}" class="btn btn-info btn-xs">
                            <i class="fa fa-box"></i> Quản lý tồn kho
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Giá</th>
                                <th>Danh mục</th>
                                <th>Tồn kho</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->ten_sanpham }}</td>
                                <td>
                                    @if($product->img)
                                        <img src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->ten_sanpham }}" style="max-width: 50px; max-height: 50px;">
                                    @else
                                        <span class="text-muted">Không có ảnh</span>
                                    @endif
                                </td>
                                <td>{{ number_format($product->giasp, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $product->category->ten_danhmuc ?? 'N/A' }}</td>
                                <td>
                                    @if($product->stock <= 10)
                                        <span class="badge bg-danger">{{ $product->stock }}</span>
                                    @elseif($product->stock <= 50)
                                        <span class="badge bg-warning">{{ $product->stock }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $product->stock }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->status == 1)
                                        <span class="badge bg-success">Hiển thị</span>
                                    @else
                                        <span class="badge bg-secondary">Ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('backend.product.edit', $product->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('backend.product.delete', $product->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
