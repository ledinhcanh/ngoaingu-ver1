@extends('client.layouts.master')
@section('title')
Trang cá nhân
@endsection
@section('content')
{{-- <section class="hero-wrap hero-wrap-2" style="background-image: url('assets/client/images/bg_1.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <h2 class="mb-4 bread">{{ $chuyenmuc1->name }}</h2>
<p class="breadcrumbs text-center"><span class="mr-2"><a href="/">Trang chủ <i
                class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2">Tin tức</span></p>
</div>
</div>
</div>
</section> --}}

<section class="ftco-section ftco-animate">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                @if (isset($giangvien))
                <div>
                    <h4 class="mb-3 text-center" style="text-transform: uppercase;">Thông tin giảng viên</h4>
                    <div class="nav-item dropdown no-arrow">
                        @if(Auth::check())
                        @if(Auth::user()->QuyenHan->id == 3 && Auth::user()->GiangVien->id == $giangvien->id)
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            style="padding: 0px;text-align: right;color: #333;position: absolute;top: 30px;right: 0px;font-size: 23px; z-index: 99;">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown" style="padding: 0;
                    margin: 0;">
                            <a class="dropdown-item" href="{{ route('profile.edit', Auth::user()->GiangVien->id) }}" style="color: #333;">
                                <i class="fa fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                Chỉnh sửa
                            </a>
                            <div class="dropdown-divider" style="padding: 0; margin: 0"></div>
                            <a class="dropdown-item" href="{{ route('doimatkhau',Auth::user()->id) }}" style="color: #333;">
                                <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đổi mật khẩu
                            </a>
                        </div>
                        @endif
                        @endif
                        <a href="" class="text-white">
                            <i class="fa fa-sign-out mr-2"></i> Đăng xuất
                        </a>
                    </div>
                    <div class="thong-tin-co-ban">
                        <h2 class="mb-4 underline" style="font-size: 17px !important;">Thông tin cơ bản
                            <span class="profile"></span></h2>
                        <div class="row">
                            <div class="col-sm-3">
                                <img typeof="foaf:Image" src="img/upload/avatar/{{ $giangvien->avatar }}" alt="" style="width: 90%;
                                        border-radius: 50%;">
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-1">
                                    <div class="profilename">Họ tên:</div>
                                    <div style="display: inline-block">{{ $giangvien->fullname }}</div>
                                </div>
                                <div class="mb-1">
                                    <div class="profilename">Năm sinh:</div>
                                    <div style="display: inline-block">
                                        {{ \Carbon\Carbon::parse($giangvien->birthday)->format('d/m/Y')}}</div>
                                </div>
                                <div class="mb-1">
                                    <div class="profilename">Email:</div>
                                    <div style="display: inline-block">{{ $giangvien->TaiKhoan->email }}</div>
                                </div>
                                <div class="mb-1">
                                    <div class="profilename">Địa chỉ:</div>
                                    <div style="display: inline-block">{{ $giangvien->address }}</div>
                                </div>
                                <div class="mb-1">
                                    <div class="profilename">Tình trạng hôn nhân:</div>
                                    <div style="display: inline-block">{{ $giangvien->TTHN->name }}</div>
                                </div>
                                <div class="mb-1">
                                    <div class="profilename">Bộ môn:</div>
                                    <div style="display: inline-block">{{ $giangvien->BoMon->name }}</div>
                                </div>
                                <div class="mb-1">
                                    <div class="profilename">Công tác tại ĐHHH từ:</div>
                                    <div style="display: inline-block">
                                        {{ \Carbon\Carbon::parse($giangvien->ngaycongtac)->format('d/m/Y')}}</div>
                                </div>
                                <div class="mb-1">
                                    <div class="profilename">Trình độ ngoại ngữ:</div>
                                    <div style="display: inline-block">{{ $giangvien->tdngoaingu }}</div>
                                </div>
                                <div class="mb-1">
                                    {{-- <div class="profilename" style="position: relative;
                                            top: -27px;">Trình độ chuyên môn:</div> --}}
                                    <div class="profilename">Trình độ chuyên môn:</div>
                                    <div style="display: inline-block;width: 62%">{{ $giangvien->tdchuyenmon }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div>
                    <h4 class="mb-3 text-center" style="text-transform: uppercase;">Thông tin sinh viên</h4>
                    <div class="nav-item dropdown no-arrow">
                        @if(Auth::check())
                        @if(Auth::user()->QuyenHan->id == 4 && Auth::user()->SinhVien->id == $sinhvien->id)
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            style="padding: 0px;text-align: right;color: #333;position: absolute;top: 30px;right: 0px;font-size: 23px; z-index: 99;">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown" style="padding: 0;
                    margin: 0;">
                            <a class="dropdown-item" href="{{ route('profile.edit', Auth::user()->SinhVien->id) }}" style="color: #333;">
                                <i class="fa fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                Chỉnh sửa
                            </a>
                            <div class="dropdown-divider" style="padding: 0; margin: 0"></div>
                            <a class="dropdown-item" href="{{ route('doimatkhau',Auth::user()->id) }}" style="color: #333;">
                                <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đổi mật khẩu
                            </a>
                        </div>
                        @endif
                        @endif
                        <a href="" class="text-white">
                            <i class="fa fa-sign-out mr-2"></i> Đăng xuất
                        </a>
                    </div>
                    <div class="thong-tin-co-ban">
                        <h2 class="mb-4 underline" style="font-size: 17px !important;">Thông tin cơ
                            bản<span class="profile"></span></h2>
                        <div class="row">
                            <div class="col-sm-3">
                                <img typeof="foaf:Image" src="img/upload/avatar/{{ $sinhvien->avatar }}" alt="" style="width: 85%;
                                                    border-radius: 50%;">
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-1">
                                    <div class="profilename">Mã SV:</div>
                                    <div style="display: inline-block">{{ $sinhvien->masv }}</div>
                                </div>
                                <div class="mb-1">
                                    <div class="profilename">Họ tên:</div>
                                    <div style="display: inline-block">{{ $sinhvien->fullname }}</div>
                                </div>
                                <div class="mb-1">
                                    <div class="profilename">Năm sinh:</div>
                                    <div style="display: inline-block">
                                        {{ \Carbon\Carbon::parse($sinhvien->birthday)->format('d/m/Y')}}
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="profilename">Giới tính:</div>
                                    <div style="display: inline-block">
                                        {{ ($sinhvien->sex == 0) ? "Nam" : "Nữ" }}</div>
                                </div>
                                <div class="mb-1">
                                    <div class="profilename">Email:</div>
                                    <div style="display: inline-block">{{ $sinhvien->TaiKhoan->email }}
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="profilename">Lớp:</div>
                                    <div style="display: inline-block">{{ $sinhvien->Lop->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div>
                    <h2 class="mb-4 underline" style="font-size: 17px !important;">Bài đăng<span class="profile"></span>
                    </h2>
                    <div class="list-group">
                        @foreach($thaoluan as $tl)
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h5 class="panel-title"><a style="color: #fff; font-size: 17px;"
                                        href="{{ route('thaoluan.detail', $tl->id) }}">{{ $tl->title }}</a>
                                </h5>
                            </div>
                            <div class="panel-body" style="padding: 0 15px;">
                                <span class="thaoluan">{!! str_limit($tl->content,100) !!}</span>
                                <p style="margin-bottom: 0px;">Tạo bởi
                                    <a href="{{ route('profile1.index', $tl->TaiKhoan->id) }}">{{ $tl->TaiKhoan->display_name }}</a>
                                    {{$tl->created_at->diffForHumans()}} | {{ $tl->view }} lượt xem
                                    | {{ $tl->BinhLuan->count() }} bình luận
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-4 sidebar ftco-animate">
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