@extends('admin.layouts.master')
@section('title')
Cập nhật
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Sinh viên <small
            style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Cập nhật</small></h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
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
                                <label>Ngày sinh <span class="text-danger">(*)</span></label>
                                <input type="date" class="form-control" name="birthday"
                                    value="{{ \Carbon\Carbon::parse($sinhvien->birthday)->format('Y-m-d')}}" />
                                @if ($errors->has('birthday'))
                                <div class="text-danger">{{ $errors->first('birthday') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label style="padding-right: 15px;">Giới tính</label><br>
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
                                <label for="avatar">Ảnh đại diện</label>
                                <p>
                                    <img width="100px" src="img/upload/avatar/{{ $sinhvien->avatar }}">
                                </p>
                                <input type="file" name="avatar" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
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

                            <div class="form-group">
                                <label>Lớp <span class="text-danger">(*)</span></label>
                                <select class="form-control idlop" name="idlop">
                                    <option value="{{ $sinhvien->Lop->id }}">{{ $sinhvien->Lop->name }}</option>
                                </select>
                                @if ($errors->has('idlop'))
                                <div class="text-danger">{{ $errors->first('idlop') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Tài khoản <span class="text-danger">(*)</span></label>
                                <select class="form-control" name="idtaikhoan">
                                    <option selected value="{{ $sinhvien->TaiKhoan->id }}">
                                        {{ $sinhvien->TaiKhoan->name }}</option>
                                    @foreach($taikhoan as $tk)
                                    @if (!($tk->SinhVien))
                                    {{-- @if (count(json_decode($tk->SinhVien)) == 0) --}}
                                    <option value="{{ $tk->id }}">{{ $tk->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer text-center">
                    <a href="{{ route('sinhvien.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i> Trở về</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection