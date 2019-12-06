@extends('client.layouts.master')
@section('title')
Tìm kiếm
@endsection
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('assets/client/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h2 class="mb-4 bread">Tìm kiếm tin tức</h2>
                <p class="breadcrumbs text-center"><span class="mr-2"><a href="/">Trang chủ <i
                                class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2">Tin tức</span></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-animate">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if(!empty($total))
                <div class="alert alert-primary" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Từ khóa <strong>{{ $keyword }}</strong> có <strong>{{ $total }}</strong> kết quả
                </div>
                @else
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Từ khóa <strong>{{ $keyword }}</strong> không tìm thấy tin tức nào
                </div>
                @endif
                {{-- <h4 class="mb-3">{{ $chuyenmuc1->name }}</h4> --}}
                @foreach ($tintuc as $tt)
                <div class="block-21 mb-4 d-flex"
                    style="align-items: center;background-color: #fff;border: none;border-radius: 8px;box-shadow: 0 2px 4px rgba(145, 112, 112, 0.1), 0 8px 16px rgba(0, 0, 0, .1);box-sizing: border-box;">
                    <a class="blog-img-tt mr-3"
                        style="background-image: url(img/upload/baiviet/{{ $tt->image }}); background-size: cover;"></a>
                    <div class="text" style="text-align: justify; padding: 5px;">
                        <h3 class="heading" style="font-size: 20px;margin-bottom: 0px;"><a
                                href="tin/{{ $tt->slug }}">{{ $tt->title }}</a></h3>
                        <div class="meta">
                            <div style="font-size: 14px;"><span class="icon-calendar"></span>
                                <?php   $a = \Carbon\Carbon::parse($tt->updated_at)->format('l');
                switch($a) {
                  case 'Monday':
                  echo 'Thứ hai';
                    break;
                  case 'Tuesday':
                  echo 'Thứ ba';
                    break;
                  case 'Wednesday':
                  echo 'Thứ tư';
                    break;
                  case 'Thursday':
                  echo 'Thứ năm';
                    break;
                  case 'Friday':
                  echo 'Thứ sáu';
                    break;
                  case 'Saturday':
                  echo 'Thứ bảy';
                    break;
                  default:
                  echo 'Chủ nhật';
                    break;
                }
            ?>, {{ \Carbon\Carbon::parse($tt->updated_at)->format(' d')}} Tháng
                                {{ \Carbon\Carbon::parse($tt->updated_at)->format(' m Y H:i A')}}</div>
                            {{-- <div><a href="#"><span class="icon-person"></span> Admin</a></div> --}}
                        </div>
                        <p style="margin-bottom: 0px;font-size: 16px; padding-right: 4px;">{{ $tt->description }}</p>
                        {{-- <div><a href="tin/{{ $tt->slug }}"> Xem tiếp...</a>
                    </div> --}}
                </div>
            </div> <!-- .col-md-8 -->
            @endforeach
            <div class="float-right">{{ $tintuc->links() }}</div>
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