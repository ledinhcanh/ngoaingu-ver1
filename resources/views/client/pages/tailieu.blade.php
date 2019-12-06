@extends('client.layouts.master')
@section('title')
Tài liệu
@endsection
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('assets/client/images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <h2 class="mb-4 bread">{{ $chuyenmuc1->name }}</h2>
        <p class="breadcrumbs text-center"><span class="mr-2"><a href="/">Trang chủ <i
                class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2">Tài liệu</span></p>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-animate">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        {{-- <h4 class="mb-3">{{ $chuyenmuc1->name }}</h4> --}}
        <!-- Form tìm kiếm -->
        <form action="{{ url('tim-kiem-tai-lieu') }}" class="mb-4">
          <div class="input-group mb-3">
            <div class="input-group-prepend" style="position: relative;">
              <select class="custom-select form-control" style="border-radius: 0px !important;"
                onchange="location = this.options[this.selectedIndex].value;">
                <option>Chọn định dạng file</option>
                @php
                $select_files = array('docx','doc','excel','word','pdf','zip','rar') // Thêm định dạng file tại đây
                @endphp
                @foreach($select_files as $item)
                <option value="{{ 'tim-kiem-file-tai-lieu/'.$item }}">.{{ $item }}</option>
                @endforeach
              </select>
              <span style="position: absolute;top: 12px;left: 180px;font-size: 18px;"><i class="fa fa-caret-down"
                  aria-hidden="true"></i></span>
            </div>
            <div class="input-group-prepend" style="position: relative;">
              <select class="custom-select form-control" name="type-search" style="border-radius: 0px !important;">
                <option value="name" selected>Tìm theo tên tài liệu</option>
                <option value="author">Tìm theo tên tác giả</option>
              </select>
              <span style="position: absolute;top: 12px;left: 182px;font-size: 18px;"><i class="fa fa-caret-down"
                  aria-hidden="true"></i></span>
            </div>
            <input type="text" style="border-radius: 0px !important;" name="keyword" class="form-control"
              aria-label="Nhập từ khóa" placeholder="Nhập từ khóa" required>
            <div class="input-group-prepend">
              <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
          </div>
          @if ($errors->has('keyword'))
          <div class="alert alert-danger" role="alert">{{ $errors->first('keyword') }}
          </div>
          @endif
        </form>
        <!-- Form tìm kiếm -->
        @if (count($tailieu) > 0)
        @foreach ($tailieu as $tl)
        <div class="block-21 mb-4 d-flex"
          style="align-items: center;background-color: #fff;border: none;border-radius: 8px;box-shadow: 0 2px 4px rgba(145, 112, 112, 0.1), 0 8px 16px rgba(0, 0, 0, .1);box-sizing: border-box;">
          <a class="blog-img-tt mr-3"
            style="background-image: url(img/upload/tailieu/{{ $tl->image }}); background-size: contain;"></a>
          <div class="text" style="text-align: justify; padding: 5px;">
            <h3 class="heading" style="font-size: 20px;margin-bottom: 0px;"><a
                href="tai-lieu/{{ $tl->slug }}">{{ $tl->name }}</a></h3>
            <div class="meta">
              <div style="font-size: 14px;"><span class="icon-calendar"></span>
                <?php   $a = \Carbon\Carbon::parse($tl->updated_at)->format('l');
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
            ?>, {{ \Carbon\Carbon::parse($tl->updated_at)->format(' d')}} Tháng
                {{ \Carbon\Carbon::parse($tl->updated_at)->format(' m Y')}}</div>
              {{-- <div><a href="#"><span class="icon-person"></span> Admin</a></div> --}}
              <div style="margin: 0px 10px 0 10px;">
                <span class="icon-eye"></span>
                {{ $tl->view}} lượt xem
              </div>
              <div>
                <span class="icon-download"></span>
                {{ $tl->download }} lượt tải
              </div>
            </div>

            {{-- <p style="margin-bottom: 0px;font-size: 16px; padding-right: 4px;">{{ $tl->description }}</p> --}}
            <div class="download"><a target="_blank"
                href="{{ 'tai-ve-tai-lieu/'.$chuyenmuc->slug.'/'.$tl->id.'/'.$tl->slug }}"
                style="font-size:18px; color: #000000;"><i class="fa fa-download pr-2 pt-4"></i>Tải về</a></div>
            {{-- <div><a href="tin/{{ $tt->slug }}"> Xem tiếp...</a>
          </div> --}}
        </div>
      </div> <!-- .col-md-8 -->
      @endforeach
      <div class="float-right">{{ $tailieu->links() }}</div>
      @else
      <div class="alert alert-danger" role="alert">
        Chưa có tài liệu nào
      </div>
      @endif
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
          <a class="blog-img mr-3 mt-1" style="background-image: url(img/upload/baiviet/{{ $bv->image }});"></a>
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
          <a class="blog-img mr-3 mt-1" style="background-image: url(img/upload/baiviet/{{ $tb->image }});"></a>
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