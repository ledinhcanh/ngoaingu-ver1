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
                <h2 class="mb-2 bread">Liên hệ</h2>
                <p class="breadcrumbs text-center"><span class="mr-2"><a href="/">Trang chủ <i
                                class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2">Liên hệ</span></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section">
    <div class="container">
        <div class="row block-9 justify-content-center mb-5">
            <div class="col-md-8 mb-md-5">
                <h2 class="text-center">NẾU BẠN CÓ BẤT KỲ CÂU HỎI NÀO
                    <br>XIN VUI LÒNG GỬI TIN NHẮN CHO CHÚNG TÔI</h2>
                @if(Session::has('thongbaolh'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('thongbaolh') !!}</strong>
                </div>
                @endif
                <form action="{{ route('lienhe.store') }}" class="bg-light p-5 contact-form" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Họ và tên" name="fullname">
                        @if ($errors->has('fullname'))
                        <div class="text-danger">{{ $errors->first('fullname') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Số điện thoại" name="phone">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Địa chỉ" name="address">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <textarea name="content" id="" cols="30" rows="7" class="form-control"
                            placeholder="Nội dung"></textarea>
                        @if ($errors->has('content'))
                        <div class="text-danger">{{ $errors->first('content') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="border-radius: 5px;">Gửi đi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container-fluid px-0">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="map" class="bg-white">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5350.144933433231!2d106.69235101389403!3d20.836312656833194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a7a9e9cfdc96b%3A0x7aeede4d5ab3d5b4!2zS2hvYSBOZ2_huqFpIG5n4buv!5e0!3m2!1svi!2s!4v1568348355060!5m2!1svi!2s"
                        width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection