

<div class="search-results container">

    <div class="back-button-wrapper">
        <a href="{{ route('frontend.sanpham.product') }}" class="custom-back-btn">
            <i class="bi bi-arrow-left-square-fill"></i>
            <span>Trở lại</span>
        </a>
    </div>

    <h4 class="mb-4">Kết quả tìm kiếm cho: <strong>{{ $keyword }}</strong></h4>
    @if ($products->count() > 0)
        <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->img) }}" class="card-img-top" alt="{{ $product->ten_sanpham }}">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('frontend.productdetail', $product->id) }}">{{ $product->ten_sanpham }}</a></h5>
                            <p class="card-text">{{ number_format($product->giasp, 0, ',', '.') }} VNĐ</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Không tìm thấy sản phẩm nào phù hợp.</p>
    @endif
</div>



<style>

/* Container chứa tất cả kết quả tìm kiếm */
.search-results {
    padding: 30px 0;
}
.mb-4{
    text-align:center;
    font-size:30px
}
/* Nút trở lại */
.back-button-wrapper {
    margin-bottom: 20px;
}
.custom-back-btn {
    display: inline-flex;
    align-items: center;
    font-size: 18px;
    text-decoration: none;
    color: #333;
}
.custom-back-btn i {
    margin-right: 8px;
    font-size: 20px;
    color: #007bff;
}
.custom-back-btn:hover {
    color: #007bff;
}

/* Grid sản phẩm */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    max-width: 1272px;
    margin: auto;
}

/* Thẻ sản phẩm */
.product-card .card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}
.product-card .card:hover {
    transform: translateY(-5px);
}

.product-card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 10px 10px 0 0;
}

/* Tên sản phẩm */
.product-card .card-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 10px;
    text-align: center;
    margin-left:5px;
}
.product-card .card-title a {
    text-decoration: none;
    color: #333;
}
.product-card .card-title a:hover {
    color: #007bff;
}

/* Giá */
.product-card .card-text {
    font-weight: bold;
    color: #e91e63; /* hồng đậm */
    text-align: center;
    font-size: 20px;
}


.custom-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background-color: #f4f4f4;
    color: #333;
    text-decoration: none;
    padding: 10px 20px;
    border: 2px solid #ccc;
    border-radius: 30px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.05);
}
.custom-back-btn i {
    font-size: 20px;
    color: #007bff;
    transition: transform 0.2s;
}
.custom-back-btn:hover {
    background-color: #e6e6e6;
    transform: translateY(-2px);
    color: #000;
}
.custom-back-btn:hover i {
    transform: scale(1.1);
    color: #0056b3;
}
</style>