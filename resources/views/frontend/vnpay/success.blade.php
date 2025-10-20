<div class="container py-5">
    <div class="success-container text-center">
        <h2 class="mb-4">Thanh toán thành công!</h2>
        <p>Cảm ơn bạn đã mua hàng của chúng tôi!.</p>

        <a href="{{ route('frontend.index') }}" class="btn btn-primary mt-4">
            Quay lại trang chủ
        </a>
        <a href="{{ route('frontend.lichsu.history') }}" class="btn btn-outline-secondary mt-2">
            Xem lịch sử đơn hàng
        </a>
    </div>
</div>

<style>
    .success-container {
        background-color: #f0fff4;
        border: 2px solid #38c172;
        border-radius: 12px;
        padding: 40px 20px;
        max-width: 600px;
        margin: 0 auto;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        animation: fadeIn 0.6s ease-in-out;
        margin-top: 50px;
    }

    .success-container h2 {
        color: #38c172;
        font-size: 2rem;
        font-weight: bold;
    }

    .success-container p {
        font-size: 1.1rem;
        margin-top: 10px;
        color: #555;
    }

    .success-container a.btn {
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 8px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .btn-primary {
        background-color: #38c172;
        border-color: #38c172;
        color: #fff;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2f9e63;
        border-color: #2f9e63;
        box-shadow: 0 4px 12px rgba(56, 193, 114, 0.4);
    }

    .btn-outline-secondary {
        border: 2px solid #ccc;
        color: #555;
        background-color: #fff;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        border-color: #38c172;
        color: #38c172;
        background-color: #f0fff4;
        box-shadow: 0 4px 10px rgba(56, 193, 114, 0.2);
    }

    .btn {
        font-weight: 600;
        border-radius: 8px;
        padding: 10px 24px;
        font-size: 1rem;
    }

    a.btn.btn-primary.mt-4 {
        text-decoration: none;
    }

    a.btn.btn-outline-secondary.mt-2 {
        text-decoration: none;
        margin-left: 30px;
    }
</style>