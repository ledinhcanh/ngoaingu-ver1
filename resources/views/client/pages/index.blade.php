@extends('client.layouts.master')
@section('title')
    Trang chủ
@endsection
@section('slide')
    @include('client.layouts.slide')
@endsection
@section('content')
<section class="ftco-section ftco-animate">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-6 wrap-about pr-md-4">
                <h2 class="mb-4 underline"><span>Giới thiệu</span></h2>
                <p>{{ $gioithieu->description }}</p>
                <a href="don-vi/{{ $gioithieu->slug }}" class="readmore">Xem thêm</a>
            </div>
            <div class="col-md-6 order-md-last wrap-about align-items-stretch">
                <h2 class="mb-4 underline"><span>Bộ môn</span></h2>
                <div class="row  no-gutters">
                    <div class="col-sm-6">
                        <div class="img d-flex justify-content-center align-items-center"
                            style="background-image: url(assets/client/images/anh7.jpg);border: none;box-shadow: 0 2px 4px rgba(130, 97, 97, 0.7), 0 8px 16px rgba(0, 0, 0, .1);box-sizing: border-box;position:relative;">
                                <a href="don-vi/bo-mon-tieng-anh-dai-cuong"style="position: absolute;bottom: 0px;font-size: 19px;color: #5e5e5e;font-weight: 900;">Tiếng Anh đại cương</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="img1 d-flex justify-content-center align-items-center"
                            style="background-image: url(assets/client/images/anh8.jpg); background-size: cover;border: none;box-shadow: 0 2px 4px rgba(130, 97, 97, 0.7), 0 8px 16px rgba(0, 0, 0, .1);box-sizing: border-box;position:relative;">
                            <a href="don-vi/bo-mon-tieng-anh-chuyen-nganh"style="position: absolute;bottom: 0px;font-size: 19px;color: #5e5e5e;font-weight: 900;">Tiếng anh chuyên ngành</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="img d-flex justify-content-center align-items-center"
                            style="background-image: url(assets/client/images/anh3.jpg); background-size: cover;border: none;box-shadow: 0 2px 4px rgba(130, 97, 97, 0.7), 0 8px 16px rgba(0, 0, 0, .1);box-sizing: border-box;position:relative;">
                             <a href="don-vi/bo-mon-dich-thuatvan-ban"style="position: absolute;bottom: 0px;font-size: 19px;color: #5e5e5e;font-weight: 900;line-height: 23px;text-align: center;">Dịch thuật, Văn hóa, Lý thuyết tiếng</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="img1 d-flex justify-content-center align-items-center"
                            style="background-image: url(assets/client/images/anh6.jpg); background-size: cover;border: none;box-shadow: 0 2px 4px rgba(130, 97, 97, 0.7), 0 8px 16px rgba(0, 0, 0, .1);box-sizing: border-box;position:relative;">
                            <a href="don-vi/bo-mon-thuc-hanh-tieng"style="position: absolute;bottom: 0px;font-size: 19px;color: #5e5e5e;font-weight: 900;">Thực hành tiếng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light ftco-animate">
    <div class="container">
        <div class="row mb-2 pb-2">
            <div class="col-md-12 heading-section tintuc">
                <h2 class="mb-2 underline"><span>Tin tức</span></h2>
                <!-- <p>Separated they live in. A small river named Duden flows by their place and supplies it with the
                    necessary regelialia. It is a paradisematic country</p> -->
            </div>
        </div>
        <div class="row">
            @foreach ($baiviet as $bv)
            <div class="col-md-6 col-lg-4">
                <div class="blog-entry">
                    <a href="tin/{{ $bv->slug }}" class="block-20 d-flex align-items-end"
                        style="background-image: url('img/upload/baiviet/{{ $bv->image }}');">
                        <div class="meta-date text-center p-2">
                            <span class="day">{{ \Carbon\Carbon::parse($bv->updated_at)->format('d')}}</span>
                            <span class="mos">{{ \Carbon\Carbon::parse($bv->updated_at)->format('F')}}</span>
                            <span class="yr">{{ \Carbon\Carbon::parse($bv->updated_at)->format('Y')}}</span>
                        </div>
                    </a>
                    <div class="text bg-white p-4">
                        <h3 class="heading" style="font-weight: 400;"><a href="tin/{{ $bv->slug }}">{{ $bv->title }}</a></h3>
                        <p>{{ $bv->description }}</p>
                        <div class="d-flex align-items-center mt-4">
                            <p class="mb-0"><a href="tin/{{ $bv->slug }}" class="btn btn-primary">Đọc tiếp <span
                                        class="ion-ios-arrow-round-forward"></span></a></p>
                            <p class="ml-auto mb-0">
                                <i class="fa fa-eye pr-2" aria-hidden="true"></i><span>{{ $bv->view }} lượt xem</span>
                            </p>
                            {{-- <p class="ml-auto mb-0">
                                <a href="#" class="mr-2">Admin</a>
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="ftco-section testimony-section ftco-animate">
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-12 heading-section">
                <h2 class="mb-2 underline"><span>Thông báo</span></h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel">
                    @foreach ($thongbao as $tb)
                        <div class="item">
                            <div class="testimony-wrap d-flex" style="height: 177.7px;">
                                <div class="user-img" style="background-image: url(img/upload/baiviet/{{ $tb->image }})">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p><a href="tin/{{ $tb->slug }}">{{ $tb->title }}</a></p>
                                    <span class="icon-calendar"></span> {{ \Carbon\Carbon::parse($bv->updated_at)->format('d/m/Y')}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
