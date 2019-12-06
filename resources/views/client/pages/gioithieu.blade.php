@extends('client.layouts.master')
@section('title')
Giới thiệu
@endsection
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('assets/client/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h2 class="mb-4 bread">Giới thiệu</h2>
                <p class="breadcrumbs text-center"><span class="mr-2"><a href="/">Trang chủ <i
                                class="ion-ios-arrow-forward"></i></a></span> <span>Đơn vị</span></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-animate">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="text-align: justify; color: #666666 !important;">
             {!! $gioithieu->content !!}
            </div>
        </div>
    </div>
</section>
@endsection