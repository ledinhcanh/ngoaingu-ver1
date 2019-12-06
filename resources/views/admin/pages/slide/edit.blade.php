@extends('admin.layouts.master')
@section('title')
Cập nhật
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Slide <small
            style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Cập nhật</small></h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form role="form" method="POST" action="{{ route('slide.update', $slide->id) }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{ $slide->id }}">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tên Slide <span class="text-danger">(*)</span></label>
                            <input class="form-control" name="name" placeholder="Nhập tên slide"
                                value="{{ $slide->name }}" />
                            @if ($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea class="form-control" rows="3" name="content"
                                placeholder="Nhập nội dung">{{ $slide->content }}</textarea>
                            @if ($errors->has('content'))
                            <div class="text-danger">{{ $errors->first('content') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image">Hình ảnh</label>
                            <p>
                                <img width="200px" src="img/upload/slide/{{ $slide->image }}">
                            </p>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>

                    {{-- <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option @if ($slide->status==1)
                                        {{ "selected" }}
                    @endif
                    value="1">Hiển thị</option>
                    <option @if ($slide->status==0)
                        {{ "selected" }}
                        @endif
                        value="0">Không hiển thị</option>
                    </select>
                </div> --}}
        </div>
        <!-- /.box-body -->

        <div class="box-footer" style="margin-left: 16px;">
            <a href="{{ route('slide.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"
                    aria-hidden="true"></i> Trở về</a>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
        </div>
        </form>
    </div>
</div>

</div>
@endsection