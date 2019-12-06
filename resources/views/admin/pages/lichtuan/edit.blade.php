@extends('admin.layouts.master')
@section('title')
Cập nhật
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Lịch tuần <small
      style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Cập nhật</small></h1>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <form role="form" method="POST" action="{{ route('lichtuan.update', $lichtuan->id) }}"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $lichtuan->id }}">
        <div class="box-body">
          <div class="form-group col-sm-6">
            <label>Tiêu đề<span class="text-danger">(*)</span></label>
            <input class="form-control" name="title" value="{{ $lichtuan->title }}" placeholder="Nhập tiêu đề" />
            @if ($errors->has('title'))
            <div class="text-danger">{{ $errors->first('title') }}</div>
            @endif
          </div>
          <div class="form-group col-sm-6">
            <label>Tuần<span class="text-danger">(*)</span></label>
            <input class="form-control" name="tuan" value="{{ $lichtuan->tuan }}" placeholder="Nhập tuần" />
            @if ($errors->has('tuan'))
            <div class="text-danger">{{ $errors->first('tuan') }}</div>
            @endif
          </div>
          <div class="form-group col-sm-6">
            <label>Năm<span class="text-danger">(*)</span></label>
            <select class="form-control" name="nam">
              <option @if ($lichtuan->nam == 2019)
                {{ "selected" }}
                @endif value="2019">2019</option>
              <option @if ($lichtuan->nam == 2020)
                {{ "selected" }}
                @endif value="2020">2020</option>
            </select>
          </div>
          <div class="form-group col-sm-6">
            <label>Từ ngày <span class="text-danger">(*)</span></label>
            <input class="form-control" type="date" value="{{ $lichtuan->tungay }}" name="tungay" />
            @if ($errors->has('tungay'))
            <div class="text-danger">{{ $errors->first('tungay') }}</div>
            @endif
          </div>
          <div class="form-group col-sm-6">
            <label>Đến ngày <span class="text-danger">(*)</span></label>
            <input class="form-control" type="date" name="denngay" value="{{ $lichtuan->denngay }}" />
            @if ($errors->has('denngay'))
            <div class="text-danger">{{ $errors->first('denngay') }}</div>
            @endif
          </div>

          <div class="form-group col-sm-6">
            <label>File<span class="text-danger">(*)</span></label>
            <div style="padding-bottom: 12px;display: inline-block;">{{ $lichtuan->file }}</div>
            <span class="pb-2 pl-2">
              {!! download_file('file/lichtuan', $lichtuan->file, null, null, null) !!}
            </span>
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