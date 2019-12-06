@extends('client.layouts.master')
@section('title')
Trang cá nhân
@endsection
@section('content')

<section class="ftco-section ftco-animate">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h2 class="mb-3">Chỉnh sửa thông tin</h2>
                @if(Session::has('thongbaott'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('thongbaott') !!}</strong>
                </div>
                @endif
                @if(Auth::user()->QuyenHan->id == 3)
                <form role="form" method="POST" action="{{ route('giangvien.update', $giangvien->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{ $giangvien->id }}">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mã giảng viên <span class="text-danger">(*)</span></label>
                                    <input class="form-control" name="magv" placeholder="Nhập mã giảng viên"
                                        value="{{ $giangvien->magv }}" />
                                    @if ($errors->has('magv'))
                                    <div class="text-danger">{{ $errors->first('magv') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Họ tên <span class="text-danger">(*)</span></label>
                                    <input class="form-control" name="fullname" placeholder="Nhập họ tên"
                                        value="{{ $giangvien->fullname }}" />
                                    @if ($errors->has('fullname'))
                                    <div class="text-danger">{{ $errors->first('fullname') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Ngày sinh <span class="text-danger">(*)</span></label>
                                    <input type="date" class="form-control" name="birthday"
                                        value="{{ \Carbon\Carbon::parse($giangvien->birthday)->format('Y-m-d')}}" />
                                    @if ($errors->has('birthday'))
                                    <div class="text-danger">{{ $errors->first('birthday') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label style="padding-right: 15px;">Giới tính <span
                                            class="text-danger">(*)</span></label><br>
                                    <label class="radio-inline">
                                        <input name="sex" value="0" @if ($giangvien->sex==0)
                                        {{ "checked" }}
                                        @endif type="radio"><span style="padding-left: 5px;">Nam</span>
                                    </label>
                                    <label class="radio-inline" style="margin-left: 25px;">
                                        <input name="sex" value="1" @if ($giangvien->sex==1)
                                        {{ "checked" }}
                                        @endif type="radio"><span style="padding-left: 5px;">Nữ</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input class="form-control" name="address" placeholder="Nhập địa chỉ"
                                        value="{{ $giangvien->address }}" />
                                    @if ($errors->has('address'))
                                    <div class="text-danger">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Trình độ ngoại ngữ</label>
                                    <input class="form-control" name="tdngoaingu" placeholder="Nhập họ tên"
                                        value="{{ $giangvien->tdngoaingu }}" />
                                    @if ($errors->has('tdngoaingu'))
                                    <div class="text-danger">{{ $errors->first('tdngoaingu') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Bộ môn <span class="text-danger">(*)</span></label>
                                    <select class="form-control idbomon" name="idbomon">
                                        <option value="">----- Chọn bộ môn -----</option>
                                        @foreach($bomon as $bm)
                                        <option @if ($giangvien->BoMon->name==$bm->name)
                                            {{ "selected" }} @endif
                                            value="{{ $bm->id }}">{{ $bm->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="avatar">Ảnh đại diện</label>
                                    <p>
                                        <img width="193px" src="img/upload/avatar/{{ $giangvien->avatar }}">
                                    </p>
                                    <input type="file" name="avatar" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Môn học <span class="text-danger">(*)</span></label>
                                    <br>
                                    @foreach ($monhoc as $mh)
                                    <label style="display: block; font-weight: normal;">
                                        <input {{ $getAll->contains($mh->id) ? "checked":"" }} type="checkbox"
                                            value="{{ $mh->id }}" name="monhoc[]"><span
                                            style="padding-left: 10px;position: relative;top: -2px;">{{$mh->name}}</span>
                                    </label>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label>Tình trạng hôn nhân <span class="text-danger">(*)</span></label>
                                    <select class="form-control idtthn" name="idtthn">
                                        <option value="">----- Chọn tình trạng hôn nhân -----</option>
                                        @foreach($tthn as $tt)
                                        <option @if ($giangvien->TTHN->name==$tt->name)
                                            {{ "selected" }} @endif
                                            value="{{ $tt->id }}">{{ $tt->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ngày công tác <span class="text-danger">(*)</span></label>
                                    <input type="date" class="form-control" name="ngaycongtac"
                                        value="{{ \Carbon\Carbon::parse($giangvien->ngaycongtac)->format('Y-m-d')}}" />
                                    @if ($errors->has('ngaycongtac'))
                                    <div class="text-danger">{{ $errors->first('ngaycongtac') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Trình độ chuyên môn <span class="text-danger">(*)</span></label>
                                    <textarea name="tdchuyenmon" class="form-control" id="" cols="30"
                                        rows="2">{{ $giangvien->tdchuyenmon }}</textarea>
                                    @if ($errors->has('tdchuyenmon'))
                                    <div class="text-danger">{{ $errors->first('tdchuyenmon') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer" style="text-align: right">
                        <button type="submit" class="btn btn-success" style="border-radius: 5px;"><i
                                class="fa fa-save"></i> Lưu</button>
                    </div>
                </form>
                @else
                <form role="form" method="POST" action="{{ route('sinhvien.update', $sinhvien->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{ $sinhvien->id }}">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mã sinh viên <span class="text-danger">(*)</span></label>
                                    <input class="form-control" name="masv" placeholder="Nhập mã sinh viên"
                                        value="{{ $sinhvien->masv }}" />
                                    @if ($errors->has('masv'))
                                    <div class="text-danger">{{ $errors->first('masv') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Họ tên <span class="text-danger">(*)</span></label>
                                    <input class="form-control" name="fullname" placeholder="Nhập họ tên"
                                        value="{{ $sinhvien->fullname }}" />
                                    @if ($errors->has('fullname'))
                                    <div class="text-danger">{{ $errors->first('fullname') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label style="padding-right: 15px;">Giới tính <span
                                            class="text-danger">(*)</span></label><br>
                                    <label class="radio-inline">
                                        <input name="sex" value="0" @if ($sinhvien->status==0)
                                        {{ "checked" }}
                                        @endif type="radio"><span style="padding-left: 5px;">Nam</span>
                                    </label>
                                    <label class="radio-inline" style="margin-left: 25px;">
                                        <input name="sex" value="1" @if ($sinhvien->status==1)
                                        {{ "checked" }}
                                        @endif type="radio"><span style="padding-left: 5px;">Nữ</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Ngày sinh <span class="text-danger">(*)</span></label>
                                    <input type="date" class="form-control" name="birthday"
                                        value="{{ \Carbon\Carbon::parse($sinhvien->birthday)->format('Y-m-d')}}" />
                                    @if ($errors->has('birthday'))
                                    <div class="text-danger">{{ $errors->first('birthday') }}</div>
                                    @endif
                                    
                                </div>
                                <div class="form-group">
                                    <label>Lớp <span class="text-danger">(*)</span></label>
                                    <select class="form-control idlop" name="idlop">
                                        <option value="{{ $sinhvien->Lop->id }}">{{ $sinhvien->Lop->name }}</option>
                                    </select>
                                    @if ($errors->has('idlop'))
                                    <div class="text-danger">{{ $errors->first('idlop') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="avatar">Ảnh đại diện</label>
                                    <p>
                                        <img width="193px" src="img/upload/avatar/{{ $sinhvien->avatar }}">
                                    </p>
                                    <input type="file" name="avatar" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Chuyên ngành <span class="text-danger">(*)</span></label>
                                    <select class="form-control idchuyennganh" name="idchuyennganh">
                                        <option value="">----- Chọn chuyên ngành -----</option>
                                        @foreach($chuyennganh as $cn)
                                        @if (count(json_decode($cn->Lop)) > 0)
                                        <option @if ($sinhvien->Lop->ChuyenNganh->name==$cn->name)
                                            {{ "selected" }}
                                            @endif
                                            value="{{ $cn->id }}">{{ $cn->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer" style="text-align: right">
                        <button type="submit" class="btn btn-success" style="border-radius: 5px;"><i
                                class="fa fa-save"></i> Lưu</button>
                    </div>
                </form>
                @endif
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