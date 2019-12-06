@extends('admin.layouts.master')
@section('title')
Thêm mới
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tài liệu <small
            style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Thêm mới</small></h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form role="form" method="POST" action="{{ route('tailieu.store') }}" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="MAX_FILE_SIZE" value="31457280"> --}}
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tên tài liệu <span class="text-danger">(*)</span></label>
                                <input class="form-control" name="name" placeholder="Tên tài liệu" />
                                @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Tác giả</label>
                                <input class="form-control" name="author" placeholder="Nhập tên tác giả" />
                                @if ($errors->has('author'))
                                <div class="text-danger">{{ $errors->first('author') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Năm xuất bản</label>
                                <input type="number" class="form-control" name="namxb"
                                    placeholder="Nhập năm xuất bản" />
                                @if ($errors->has('namxb'))
                                <div class="text-danger">{{ $errors->first('namxb') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Ngôn ngữ <span class="text-danger">(*)</span></label>
                                <select class="form-control" name="idngonngu">
                                    <option value="">----- Chọn ngôn ngữ -----</option>
                                    @foreach($ngonngu as $nn)
                                    <option value="{{ $nn->id }}">{{ $nn->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('idngonngu'))
                                <div class="text-danger">{{ $errors->first('idngonngu') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Nhà xuất bản <span class="text-danger">(*)</span></label>
                                <select class="form-control" name="idnhaxuatban">
                                    <option value="">----- Chọn nhà xuất bản -----</option>
                                    @foreach($nhaxuatban as $nxb)
                                    <option value="{{ $nxb->id }}">{{ $nxb->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('idnhaxuatban'))
                                <div class="text-danger">{{ $errors->first('idnhaxuatban') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Loại tài liệu <span class="text-danger">(*)</span></label>
                                <select class="form-control" name="idloaitailieu">
                                    <option value="">----- Chọn loại tài liệu -----</option>
                                    @foreach($loaitailieu as $ltt)
                                    <option value="{{ $ltt->id }}">{{ $ltt->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('idloaitailieu'))
                                <div class="text-danger">{{ $errors->first('idloaitailieu') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="image">Hình ảnh</label>
                                <input type="file" name="image" class="form-control" accept="image/jpeg,image/gif,image/png">
                            </div>

                            <div class="form-group">
                                <label for="attached">File đính kèm <span class="text-danger">(*)</span></label>
                                <input type="file" name="attached" class="form-control"
                                       accept="application/pdf,application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/x-rar-compressed, application/octet-stream, application/zip, application/octet-stream, application/x-zip-compressed, multipart/x-zip">
                                @if($errors->has('attached'))
                                    <div class="text-danger">{{ $errors->first('attached') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Mô tả <span class="text-danger">(*)</span></label>
                                <textarea class="form-control" rows="3" name="description"
                                    placeholder="Nhập mô tả" /></textarea>
                                @if ($errors->has('description'))
                                <div class="text-danger">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="my-editor" name="content" cols="5" rows="5"
                                    class="form-control"></textarea>
                                @if($errors->has('content'))
                                <div class="text-danger">{{ $errors->first('content') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('tailieu.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i> Trở về</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection