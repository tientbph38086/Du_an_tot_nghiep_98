<!-- Testimonial Start -->
<div class="testimonial-area testimonial-padding">
    <div class="banner">
        <h2>Đánh giá từ <span> khách hàng</span></h2>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-9 col-md-9">

                @if ($reviews->count() > 0)
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            @foreach ($reviews as $index => $review)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="single-testimonial pt-65">
                                        <div class="font-back-tittle mb-105">
                                            <div class="archivment-front">
                                                <img src="{{ $review->user->avatar ? asset('storage/' . $review->user->avatar) : asset('assets/client/assets/img/businessman/businessman-1.jpg') }}"
                                                    alt="{{ $review->user->name }}" class="rounded-circle mb-3"
                                                    width="80" height="80">
                                            </div>
                                            <h3 class="archivment-back">Lumora Hotel</h3>
                                        </div>
                                        <div class="testimonial-caption text-center">
                                            <p>{{ $review->comment }}</p>
                                            <div class="testimonial-ratting">
                                                @php
                                                    $rating = $review->rating ?? 0;
                                                @endphp
                                                {!! str_repeat('★', $rating) !!}{!! str_repeat('☆', 5 - $rating) !!}
                                            </div>
                                            <div class="rattiong-caption">
                                                <span>
                                                    {{ $review->user->name ?? 'Khách hàng' }},
                                                    <span>{{ $review->created_at->format('d/m/Y') }}</span>
                                                </span>
                                                @if ($review->response)
                                                    <div class="response-section mt-3 p-3 bg-light rounded">
                                                        <h6 class="mb-2 text-dark">
                                                            <i class="fas fa-reply me-2"></i>
                                                            Phản hồi từ khách sạn
                                                        </h6>
                                                        <p class="mb-0">{{ $review->response }}</p>
                                                        <small class="text-muted">
                                                            {{ $review->updated_at->format('d/m/Y H:i') }}
                                                        </small>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($reviews->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        @endif
                    </div>
                @else
                    <p class="text-center">Chưa có đánh giá nào.</p>
                @endif

            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->

</section>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS + Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    /* Tổng thể */
    .testimonial-area {
        background: #fff;
        padding: 80px 0;
        position: relative;
    }

    .testimonial-padding {
        padding-top: 70px;
        padding-bottom: 70px;
    }

    /* Tiêu đề chữ mờ phía sau */
    .font-back-tittle {
        position: relative;
        text-align: center;
    }

    .banner h2 {
        padding-top: 20px;
        margin-bottom: 50px;
    }

    .archivment-back {
        font-size: 130px;
        font-weight: 700;
        color: rgba(0, 0, 0, 0.03);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        white-space: nowrap;
    }

    .archivment-front img {
        border-radius: 50%;
        border: 5px solid #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        width: 90px;
        height: 90px;
        object-fit: cover;
        position: relative;
        z-index: 2;
    }

    /* Nội dung */
    .testimonial-caption {
        position: relative;
        z-index: 3;
        margin-top: 30px;
    }

    .testimonial-caption p {
        font-size: 18px;
        color: #555;
        line-height: 1.7;
        max-width: 800px;
        margin: 0 auto 20px;
    }

    .testimonial-ratting {
        color: #fbb710;
        margin-bottom: 10px;
    }

    .testimonial-ratting i {
        font-size: 18px;
        margin: 0 2px;
    }

    .rattiong-caption span {
        font-weight: 700;
        font-size: 16px;
        color: #0b1c39;
    }

    .rattiong-caption span span {
        font-weight: 400;
        color: #777;
    }

    /* Nút điều hướng */
    .h1-testimonial-active {
        position: relative;
    }

    .h1-testimonial-active .slick-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: #e0a800;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        color: #fff;
        text-align: center;
        line-height: 45px;
        font-size: 20px;
        cursor: pointer;
        transition: background 0.3s;
        z-index: 10;
    }

    .h1-testimonial-active .slick-prev {
        left: -60px;
    }

    .h1-testimonial-active .slick-next {
        right: -60px;
    }

    .h1-testimonial-active .slick-arrow:hover {
        background: #c78b00;
    }
</style>
