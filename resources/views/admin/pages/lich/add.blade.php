@extends('admin.layouts.master')
@section('title')
Sự kiện
@endsection

@section('content')
<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Sự kiện <small style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Thêm mới</small></h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form role="form" method="POST" action="{{ route('lich.store') }}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group col-sm-6">
                                <label>Tên mục <span class="text-danger">(*)</span></label>
                                <input class="form-control" name="title" placeholder="Nhập tiêu đề" />
                                @if ($errors->has('title'))
                                <div class="text-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Màu <span class="text-danger">(*)</span></label>
                                <input class="form-control" type="color" name="color" />
                                  @if ($errors->has('color'))
                                <div class="text-danger">{{ $errors->first('color') }}</div>
                                @endif
                            </div>
                             <div class="form-group col-sm-6">
                                <label>Ngày bắt đầu <span class="text-danger">(*)</span></label>
                                <input class="form-control" type="date" name="start_date" />
                                  @if ($errors->has('start_date'))
                                <div class="text-danger">{{ $errors->first('start_date') }}</div>
                                @endif
                            </div>
                             <div class="form-group col-sm-6">
                                <label>Ngày kết thúc <span class="text-danger">(*)</span></label>
                                <input class="form-control" type="date" name="end_date" />
                                  @if ($errors->has('end_date'))
                                <div class="text-danger">{{ $errors->first('end_date') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer" style="margin-left: 16px;">
                            <a href="{{ route('lich.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Trở về</a>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                        </div>
                    </form>
            </div>
          </div>

        </div>
@endsection