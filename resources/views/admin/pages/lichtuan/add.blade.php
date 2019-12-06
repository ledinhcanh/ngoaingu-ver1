@extends('admin.layouts.master')
@section('title')
Sự kiện
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Sự kiện <small
      style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Thêm mới</small></h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <form role="form" method="POST" action="{{ route('lichtuan.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
          <div class="form-group col-sm-6">
            <label>Tiêu đề<span class="text-danger">(*)</span></label>
            <input class="form-control" name="title" type="text" placeholder="Nhập tiêu đề"/>
            @if ($errors->has('title'))
            <div class="text-danger">{{ $errors->first('title') }}</div>
            @endif
          </div>
          <div class="form-group col-sm-6">
            <label>Tuần<span class="text-danger">(*)</span></label>
            <input class="form-control" name="tuan" type="number" />
            @if ($errors->has('tuan'))
            <div class="text-danger">{{ $errors->first('tuan') }}</div>
            @endif
          </div>
          <div class="form-group col-sm-6">
            <label>Năm<span class="text-danger">(*)</span></label>
            <select class="form-control" name="nam">
              <option value="2019">2019</option>
              <option value="2020">2020</option>
            </select>
          </div>
          <div class="form-group col-sm-6">
            <label>Từ ngày <span class="text-danger">(*)</span></label>
            <input class="form-control" type="date" name="tungay" />
            @if ($errors->has('tungay'))
            <div class="text-danger">{{ $errors->first('tungay') }}</div>
            @endif
          </div>
          <div class="form-group col-sm-6">
            <label>Đến ngày <span class="text-danger">(*)</span></label>
            <input class="form-control" type="date" name="denngay" />
            @if ($errors->has('denngay'))
            <div class="text-danger">{{ $errors->first('denngay') }}</div>
            @endif
          </div>
          <div class="form-group col-sm-6">
            <label for="attached">File<span class="text-danger">(*)</span></label>
            <input type="file" name="file" class="form-control"
              accept="application/pdf,application/msword,application/octet-stream,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
            @if($errors->has('file'))
            <div class="text-danger">{{ $errors->first('file') }}</div>
            @endif
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer" style="margin-left: 16px;">
          <a href="{{ route('lichtuan.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"
              aria-hidden="true"></i> Trở về</a>
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection