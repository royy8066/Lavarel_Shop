@extends('backend.layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
.dashboard-stats {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.stat-card {
    background: rgba(255,255,255,0.95);
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

.stat-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 24px;
    color: white;
}

.stat-icon.revenue { background: linear-gradient(135deg, #667eea, #764ba2); }
.stat-icon.orders { background: linear-gradient(135deg, #f093fb, #f5576c); }
.stat-icon.pending { background: linear-gradient(135deg, #fa709a, #fee140); }
.stat-icon.products { background: linear-gradient(135deg, #30cfd0, #330867); }

.stat-number {
    font-size: 32px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
}

.stat-label {
    color: #7f8c8d;
    font-size: 14px;
    font-weight: 500;
}

.stat-change {
    font-size: 12px;
    margin-top: 10px;
    padding: 5px 10px;
    border-radius: 20px;
    display: inline-block;
}

.stat-change.positive { background: #d4edda; color: #155724; }
.stat-change.neutral { background: #fff3cd; color: #856404; }

.chart-container {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.chart-title {
    font-size: 20px;
    font-weight: 600;
    color: #2c3e50;
}

.chart-period {
    display: flex;
    gap: 10px;
}

.period-btn {
    padding: 8px 16px;
    border: 1px solid #e0e0e0;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.period-btn.active {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-color: transparent;
}

.recent-orders {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.table-modern {
    border-radius: 10px;
    overflow: hidden;
}

.table-modern thead {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.table-modern th {
    border: none;
    padding: 15px;
    font-weight: 500;
    font-size: 14px;
}

.table-modern td {
    padding: 15px;
    vertical-align: middle;
    border-bottom: 1px solid #f0f0f0;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-confirmed { background: #d4edda; color: #155724; }
.status-shipping { background: #cce5ff; color: #004085; }

.top-products {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.product-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.product-item:last-child {
    border-bottom: none;
}

.product-rank {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
    margin-right: 15px;
}

.product-info {
    flex: 1;
}

.product-name {
    font-weight: 500;
    color: #2c3e50;
    margin-bottom: 3px;
}

.product-sales {
    font-size: 13px;
    color: #7f8c8d;
}

.product-count {
    font-weight: 600;
    color: #667eea;
}

.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 30px;
    color: white;
}

.header-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 10px;
}

.header-subtitle {
    opacity: 0.9;
    font-size: 16px;
}

@media (max-width: 768px) {
    .stat-card {
        margin-bottom: 20px;
    }
    
    .chart-header {
        flex-direction: column;
        gap: 20px;
    }
    
    .table-modern {
        font-size: 14px;
    }
}
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="header-title">Dashboard</div>
    <div class="header-subtitle">Chào mừng đến với hệ thống quản lý Trầm Hương Tiên Phước</div>
</div>

<div class="dashboard-stats">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon revenue">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-number">{{ number_format($tongDoanhThu ?? 0) }}</div>
                <div class="stat-label">Doanh thu</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> {{ $tangTruong ?? 0 }}%
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon orders">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-number">{{ $tongDonHang ?? 0 }}</div>
                <div class="stat-label">Tổng đơn hàng</div>
                <div class="stat-change neutral">
                    <i class="fas fa-check"></i> {{ $donXacNhan ?? 0 }} xác nhận
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number">{{ $donCho ?? 0 }}</div>
                <div class="stat-label">Chờ xử lý</div>
                <div class="stat-change neutral">
                    <i class="fas fa-hourglass-half"></i> Đang chờ
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon products">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-number">{{ $tongSanPham ?? 0 }}</div>
                <div class="stat-label">Sản phẩm</div>
                <div class="stat-change neutral">
                    <i class="fas fa-cubes"></i> Tổng kho
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="chart-container">
            <div class="chart-header">
                <div class="chart-title">📈 Biểu đồ doanh thu</div>
                <div class="chart-period">
                    <button class="period-btn active">12 tháng</button>
                    <button class="period-btn">6 tháng</button>
                    <button class="period-btn">3 tháng</button>
                </div>
            </div>
            <div style="position: relative; height: 300px;">
                <canvas id="doanhThuChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="top-products">
            <div class="chart-header">
                <div class="chart-title">🔥 Sản phẩm bán chạy</div>
            </div>
            @forelse($topProducts ?? [] as $index => $product)
            <div class="product-item">
                <div class="product-rank">{{ $index + 1 }}</div>
                <div class="product-info">
                    <div class="product-name">{{ $product->ten_sanpham }}</div>
                    <div class="product-sales">{{ $product->order_count }} đơn hàng</div>
                </div>
                <div class="product-count">{{ $product->total_sold }}</div>
            </div>
            @empty
            <div class="text-center py-4">
                <div class="text-muted">
                    <i class="fas fa-box-open fa-3x mb-3"></i>
                    <p>Chưa có dữ liệu bán hàng trong 30 ngày qua</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<div class="recent-orders">
    <div class="chart-header">
        <div class="chart-title">📋 Đơn hàng gần đây</div>
        <a href="{{ route('backend.donhang.qldh') }}" class="period-btn">Xem tất cả</a>
    </div>
    <div class="table-responsive">
        <table class="table table-modern">
            <thead>
                <tr>
                    <th>Mã ĐH</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>#12345</strong></td>
                    <td>Nguyễn Văn A</td>
                    <td><strong>{{ number_format(1200000, 0, ',', '.') }} đ</strong></td>
                    <td><span class="status-badge status-pending">Chờ xác nhận</span></td>
                    <td>06/02/2026</td>
                </tr>
                <tr>
                    <td><strong>#12344</strong></td>
                    <td>Trần Thị B</td>
                    <td><strong>{{ number_format(850000, 0, ',', '.') }} đ</strong></td>
                    <td><span class="status-badge status-confirmed">Đã xác nhận</span></td>
                    <td>05/02/2026</td>
                </tr>
                <tr>
                    <td><strong>#12343</strong></td>
                    <td>Lê Văn C</td>
                    <td><strong>{{ number_format(2500000, 0, ',', '.') }} đ</strong></td>
                    <td><span class="status-badge status-shipping">Đang giao</span></td>
                    <td>05/02/2026</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Dữ liệu từ Laravel
    window.chartData = {
        labels: {!! json_encode($labels ?? ['T3/25', 'T4/25', 'T5/25', 'T6/25', 'T7/25', 'T8/25', 'T9/25', 'T10/25', 'T11/25', 'T12/25', 'T1/26', 'T2/26']) !!},
        data: {!! json_encode($chartData ?? [1000000, 1200000, 900000, 1500000, 1800000, 2000000, 1700000, 2200000, 1900000, 2500000, 2100000, 2300000]) !!}
    };
</script>

<script>
    $(document).ready(function() {
        console.log('Labels:', window.chartData.labels);
        console.log('Chart Data:', window.chartData.data);
        
        var ctx = document.getElementById('doanhThuChart').getContext('2d');
        
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: window.chartData.labels,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: window.chartData.data,
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderColor: 'rgba(102, 126, 234, 1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(102, 126, 234, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                return 'Doanh thu: ' + context.parsed.y.toLocaleString('vi-VN') + ' đ';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return (value / 1000000).toFixed(1) + 'M';
                            },
                            font: {
                                size: 12
                            },
                            color: '#7f8c8d'
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            },
                            color: '#7f8c8d'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
        
        console.log('Chart rendered successfully');
    });
</script>
@endpush
@endsection
