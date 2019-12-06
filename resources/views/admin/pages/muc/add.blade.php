@extends('admin.layouts.master')
@section('title')
Trang chủ
@endsection

@section('content')
<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Mục <small style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Thêm mới</small></h1>
          

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form role="form" method="POST" action="{{ route('muc.store') }}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label>Tên mục <span class="text-danger">(*)</span></label>
                                <input class="form-control" name="name" placeholder="Nhập tên mục" />
                                @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            {{-- <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Không hiểu thị</option>
                                </select>
                            </div> --}}
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer" style="margin-left: 16px;">
                            <a href="{{ route('muc.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Trở về</a>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                        </div>
                    </form>
            </div>
          </div>

        </div>
@endsection