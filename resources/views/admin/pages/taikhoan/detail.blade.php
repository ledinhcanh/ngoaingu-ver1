@extends('admin.layouts.master')
@section('title')
Thông tin tài khoản
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thông tin tài khoản</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form role="form" method="POST" action="{{ route('taikhoan.update', $taikhoan->id) }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{ $taikhoan->id }}">
                <div class="box-body">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tên tài khoản</label>
                            <input class="form-control" name="name" placeholder="Nhập tên mục" readonly=""
                                value="{{ $taikhoan->name }}" />
                            @if ($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="Nhập email"
                                value="{{ $taikhoan->email }}" />
                            @if($errors->has('email'))
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="changePassword" id="changePassword">
                            <label>Đổi mật khẩu</label>

                            <input type="password" class="form-control password" name="password"
                                placeholder="Nhập mật khẩu" disabled />
                            @if($errors->has('password'))
                            <div class="text-danger">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu </label>
                            <input type="password" class="form-control password" name="passwordAgain"
                                placeholder="Nhập lại mật khẩu" disabled />
                            @if($errors->has('passwordAgain'))
                            <div class="text-danger">{{ $errors->first('passwordAgain') }}</div>
                            @endif
                        </div>

                        {{-- <div class="form-group">
                            <label>Quyền hạn</label>
                            <select class="form-control" name="idquyenhan">
                                @foreach ($quyenhan as $qh)
                                <option @if ($taikhoan->idquyenhan == $qh->id)
                                    {{"selected"}}
                                    @endif
                                    value="{{ $qh->id }}">{{ $qh->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer" style="margin-left: 16px;">
                    <a href="admin" class="btn btn-primary"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i> Trở về</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection