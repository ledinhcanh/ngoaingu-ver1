@extends('client.layouts.master')
@section('title')
Quên mật khẩu
@endsection
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('assets/client/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h2 class="mb-2 bread">Quên mật khẩu</h2>
                <p class="breadcrumbs text-center"><span class="mr-2"><a href="/">Trang chủ </a></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section">
    <div class="container">
        <div class="row block-9 justify-content-center mb-5">
            <div class="col-md-8 mb-md-5">
                <h2 class="text-center">KHÔI PHỤC MẬT KHẨU</h2>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    Chúng tôi đã gửi Email liên kết đặt lại mật khẩu của bạn!
                </div>
                @endif
                @if($errors->has('email'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Địa chỉ Email không tồn tại. Vui lòng kiểm tra lại</strong>
                </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}" class="bg-light p-5 contact-form">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email khôi phục: </label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                required autocomplete="email" autofocus>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" style="border-radius: 5px;">
                                Gửi đi
                            </button>
                        </div>
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