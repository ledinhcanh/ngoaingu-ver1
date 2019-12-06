@extends('client.layouts.master')
@section('title')
Trang cá nhân
@endsection
@section('content')

<section class="ftco-section ftco-animate">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h2 class="mb-3">Đổi mật khẩu</h2>
                @if(Session::has('thongbaomk'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('thongbaomk') !!}</strong>
                </div>
                @endif
                @if(Session::has('thongbaotc'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('thongbaotc') !!}</strong>
                </div>
                @endif
                <form role="form" method="POST" action="">
                    @csrf
                    {{-- <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{ $sinhvien->id }}"> --}}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>Mật khẩu hiện tại <span class="text-danger">(*)</span></label>
                                    <input type="password" class="form-control" name="passwordold"/>
                                    @if ($errors->has('masv'))
                                    <div class="text-danger">{{ $errors->first('passwordold') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu mới <span class="text-danger">(*)</span></label>
                                    <input type="password" class="form-control" name="password"/>
                                    @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Xác nhận mật khẩu <span class="text-danger">(*)</span></label>
                                    <input type="password" class="form-control" name="passwordAgain"/>
                                    @if ($errors->has('passwordAgain'))
                                    <div class="text-danger">{{ $errors->first('passwordAgain') }}</div>
                                    @endif    
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success" style="border-radius: 5px;"><i
                                class="fa fa-save"></i> Lưu</button>
                    </div>
                </form>
                {{-- @endif --}}
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