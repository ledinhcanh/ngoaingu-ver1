@extends('admin.layouts.master')
@section('title')
Thêm mới
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Giảng viên <small
            style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Thêm mới</small></h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form role="form" method="POST" action="{{ route('giangvien.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Mã giảng viên <span class="text-danger">(*)</span></label>
                                <input class="form-control" name="magv" placeholder="Nhập mã giảng viên" />
                                @if ($errors->has('magv'))
                                <div class="text-danger">{{ $errors->first('magv') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Họ tên <span class="text-danger">(*)</span></label>
                                <input class="form-control" name="fullname" placeholder="Nhập họ tên" />
                                @if ($errors->has('fullname'))
                                <div class="text-danger">{{ $errors->first('fullname') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Ngày sinh <span class="text-danger">(*)</span></label>
                                <input type="date" class="form-control" name="birthday" />
                                @if ($errors->has('birthday'))
                                <div class="text-danger">{{ $errors->first('birthday') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label style="padding-right: 15px;">Giới tính <span
                                        class="text-danger">(*)</span></label><br>
                                <label class="radio-inline">
                                    <input name="sex" value="0" checked="" type="radio"><span
                                        style="padding-left: 5px;">Nam</span>
                                </label>
                                <label class="radio-inline" style="margin-left: 25px;">
                                    <input name="sex" value="1" type="radio"><span style="padding-left: 5px;">Nữ</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="image">Ảnh đại diện</label>
                                <input type="file" name="avatar" class="form-control">
                                @if($errors->has('avatar'))
                                <div class="text-danger">{{ $errors->first('avatar') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control" name="address" placeholder="Nhập địa chỉ" />
                                @if ($errors->has('address'))
                                <div class="text-danger">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Ngày công tác <span class="text-danger">(*)</span></label>
                                <input type="date" class="form-control" name="ngaycongtac" />
                                @if ($errors->has('ngaycongtac'))
                                <div class="text-danger">{{ $errors->first('ngaycongtac') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Trình độ chuyên môn <span class="text-danger">(*)</span></label>
                                <textarea name="tdchuyenmon" class="form-control" id="" cols="30" rows="2"></textarea>
                                @if ($errors->has('tdchuyenmon'))
                                <div class="text-danger">{{ $errors->first('tdchuyenmon') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Trình độ ngoại ngữ</label>
                                <input class="form-control" name="tdngoaingu" placeholder="Nhập họ tên" />
                                @if ($errors->has('tdngoaingu'))
                                <div class="text-danger">{{ $errors->first('tdngoaingu') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Tình trạng hôn nhân <span class="text-danger">(*)</span></label>
                                <select class="form-control idtthn" name="idtthn">
                                    <option value="">----- Tình trạng hôn nhân -----</option>
                                    @foreach($tthn as $tt)
                                    <option value="{{ $tt->id }}">{{ $tt->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('idtthn'))
                                <div class="text-danger">{{ $errors->first('idtthn') }}</div>
                                @endif
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Môn học <span class="text-danger">(*)</span></label>
                                <br>
                                @foreach ($monhoc as $mh)
                                <label style="display: block; font-weight: normal;">
                                    <input type="checkbox" value="{{ $mh->id }}" name="monhoc[]"><span
                                        style="padding-left: 10px;position: relative;top: -2px;">{{$mh->name}}</span>
                                </label>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Bộ môn <span class="text-danger">(*)</span></label>
                                <select class="form-control idbomon" name="idbomon">
                                    <option value="">----- Chọn bộ môn -----</option>
                                    @foreach($bomon as $bm)
                                    <option value="{{ $bm->id }}">{{ $bm->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('idbomon'))
                                <div class="text-danger">{{ $errors->first('idbomon') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Tài khoản <span class="text-danger">(*)</span></label>
                                <select class="form-control" name="idtaikhoan">
                                    @foreach($taikhoan as $tk)
                                    @if (!($tk->GiangVien))
                                    {{-- @if (count(json_decode($tk->GiangVien)) == 0) --}}
                                    <option value="{{ $tk->id }}">{{ $tk->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{ route('giangvien.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i> Trở về</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection