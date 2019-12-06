@extends('client.layouts.master')
@section('title')
Tin tức
@endsection
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('assets/client/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h2 class="mb-4 bread">Lịch tuần</h2>
                <p class="breadcrumbs text-center"><span class="mr-2"><a href="/"><i class="fa fa-home pr-2"
                                aria-hidden="true" style="font-size: 22px;"></i>Trang chủ</a></span></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-animate">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h4 class="mb-3">Lịch sinh hoạt chào cờ</h4>
                <div>
                    <iframe
                        src="https://calendar.google.com/calendar/embed?src=f99oetcir031uhorlastdp6v98%40group.calendar.google.com&ctz=Asia%2FHo_Chi_Minh"
                        style="border: 0" width="750" height="600" frameborder="0" scrolling="no"></iframe>

                </div>
                <div class="fb-comments" data-href="http://127.0.0.1:8000/lich" data-width="730" data-numposts="5" style=""></div>
            </div>

            <div class="col-lg-4 sidebar ftco-animate">
                {{-- <div class="sidebar-box">
            <form action="#" class="search-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Nhập nội dung cần tìm kiếm">
                <button type="submit" class="icon icon-search"></button>
              </div>
            </form>
          </div> --}}

                <div class="sidebar-box ftco-animate">
                    <h3 style="font-size: 20px;font-weight: 700;">Bài viết mới nhất</h3>
                    @foreach ($baiviet1 as $bv)
                    <div class="block-21 mb-2 d-flex" style="border-bottom: 1px dashed #ddd; padding-bottom: 13px;">
                        <a class="blog-img mr-3 mt-1"
                            style="background-image: url(img/upload/baiviet/{{ $bv->image }});"></a>
                        <div class="text">
                            <h3 class="heading mb-1" style="text-align: justify; font-size: 16px;"><a
                                    href="tin/{{ $bv->slug }}">{{ $bv->title }}</a></h3>
                            <div class="meta pt-1">
                                <div style="font-size: 14px;"><span class="icon-calendar"></span>
                                    {{ \Carbon\Carbon::parse($bv->updated_at)->format('d/m/Y')}}</div>
                                {{-- <div><a href="#"><span class="icon-person"></span> Admin</a></div> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="sidebar-box ftco-animate">
                    <h3 style="font-size: 20px;font-weight: 700;">Thông báo</h3>
                    @foreach ($thongbao as $tb)
                    <div class="block-21 mb-2 d-flex" style="border-bottom: 1px dashed #ddd; padding-bottom: 13px;">
                        <a class="blog-img mr-3 mt-1"
                            style="background-image: url(img/upload/baiviet/{{ $tb->image }});"></a>
                        <div class="text">
                            <h3 class="heading mb-1" style="text-align: justify; font-size: 16px;"><a
                                    href="tin/{{ $tb->slug }}">{{ $tb->title }}</a></h3>
                            <div class="meta pt-1">
                                <div style="font-size: 14px;"><span class="icon-calendar"></span>
                                    {{ \Carbon\Carbon::parse($tb->updated_at)->format('d/m/Y')}}</div>
                                {{-- <div><a href="#"><span class="icon-person"></span> Admin</a></div> --}}
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