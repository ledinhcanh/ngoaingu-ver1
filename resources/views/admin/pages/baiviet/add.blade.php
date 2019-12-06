@extends('admin.layouts.master')
@section('title')
Thêm mới
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Bài viết <small
            style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Thêm mới</small></h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form role="form" method="POST" action="{{ route('baiviet.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tên mục</label>
                                        <select class="form-control idmuc" name="idmuc">
                                            <option value="">----- Chọn mục -----</option>
                                            @foreach($muc as $m)
                                            @if (count(json_decode($m->ChuyenMuc)) > 0)
                                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tên chuyên mục</label>
                                        <select class="form-control idchuyenmuc" name="idchuyenmuc">
                                            <option value="">----- Chọn chuyên mục -----</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label>Tin theo dòng</label>
                                    <select name="tintheodong[]" multiple id="tintheodong" class="form-control" style="height: 80px !important;">
                                        @foreach($tintheodong as $ttd)
                                        <option value="{{$ttd->id}}">{{$ttd->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="title" placeholder="Nhập tiêu đề bài viết"
                                    value="{{ old('title') }}">
                                @if($errors->has('title'))
                                <div class="text-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description" cols="3" rows="3" class="form-control"
                                    placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                                @if($errors->has('description'))
                                <div class="text-danger">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="image">Ảnh minh họa</label>
                                <input type="file" name="image" class="form-control">
                                @if($errors->has('image'))
                                <div class="text-danger">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Nội dung</label>
                            <textarea id="my-editor" name="content" cols="5" rows="5" class="form-control"></textarea>
                            @if($errors->has('content'))
                            <div class="text-danger">{{ $errors->first('content') }}</div>
                            @endif
                        </div>
                    </div>

                    {{-- <div class="form-group">
                                    <label>Nổi bật</label>
                                    <select class="form-control" name="highlight">
                                        <option value="1">Có</option>
                                        <option value="0">Không</option>
                                    </select>
                                </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control" name="status">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Không hiểu thị</option>
                                </select>
                            </div> --}}
                </div>
                <!-- /.box-body -->

                <div class="box-footer" style="margin-left: 16px;">
                    <a href="{{ route('baiviet.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i> Trở về</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection