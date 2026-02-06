<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Loại khách</th>
            <th>SĐT</th>
            <th>Phương thức thanh toán</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->fullname }}</td>
                <td>
                    @if($order->user_id)
                        <span class="label label-primary">Đã đăng nhập</span>
                    @else
                        <span class="label label-default">Khách vãng lai</span>
                    @endif
                </td>
                <td>{{ $order->sdt }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>{{ number_format($order->tongtien) }} đ</td>
                <td>
                    @if($order->trang_thai == 'Chờ xác nhận')
                        <span class="label label-warning">{{ $order->trang_thai }}</span>
                    @elseif($order->trang_thai == 'Đơn hàng đã được gửi đi')
                        <span class="label label-success">{{ $order->trang_thai }}</span>
                    @else
                        <span class="label label-info">{{ $order->trang_thai ?? 'Chưa xác định' }}</span>
                    @endif
                </td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('backend.donhang.showdh', $order->id) }}" class="btn btn-info btn-sm" title="Xem chi tiết">
                        <i class="fa fa-eye"></i>
                    </a>
                    @if($order->trang_thai == 'Chờ xác nhận')
                        <form action="{{ route('backend.donhang.duyetdh', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm" title="Duyệt đơn" onclick="return confirm('Xác nhận duyệt đơn hàng này?')">
                                <i class="fa fa-check"></i>
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('backend.donhang.delete', $order->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này không?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Xóa">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center">Không có đơn hàng nào</td>
            </tr>
        @endforelse
    </tbody>
</table>

@if($orders->hasPages())
    <div class="text-center">
        {{ $orders->appends(['tab' => request('tab', 'all')])->links() }}
    </div>
@endif
