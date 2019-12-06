@extends('admin.layouts.master')
@section('title')
Thêm mới
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tài khoản <small
            style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Thêm mới</small></h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form role="form" method="POST" action="{{ route('taikhoan.store') }}">
                @csrf
                <div class="box-body">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tên tài khoản <span class="text-danger">(*)</span></label>
                            <input class="form-control" name="name" placeholder="Nhập tên tài khoản"
                                value="{{ old('name') }}" />
                            @if ($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tên hiển thị <span class="text-danger">(*)</span></label>
                            <input class="form-control" name="display_name" placeholder="Nhập tên hiển thị"
                                value="{{ old('display_name') }}" />
                            @if ($errors->has('display_name'))
                            <div class="text-danger">{{ $errors->first('display_name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Email <span class="text-danger">(*)</span></label>
                            <input class="form-control" name="email" placeholder="Nhập email"
                                value="{{ old('email') }}" />
                            @if($errors->has('email'))
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Password <span class="text-danger">(*)</span></label>
                            <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" />
                            @if($errors->has('password'))
                            <div class="text-danger">{{ $errors->first('password') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Nhập lại Password <span class="text-danger">(*)</span></label>
                            <input type="password" class="form-control" name="passwordAgain"
                                placeholder="Nhập lại mật khẩu" />
                            @if($errors->has('passwordAgain'))
                            <div class="text-danger">{{ $errors->first('passwordAgain') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Quyền hạn</label>
                            <select class="form-control" name="idquyenhan">
                                @foreach ($quyenhan as $qh)
                                <option value="{{ $qh->id }}">{{ $qh->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer" style="margin-left: 16px;">
                    <a href="{{ route('taikhoan.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i> Trở về</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection