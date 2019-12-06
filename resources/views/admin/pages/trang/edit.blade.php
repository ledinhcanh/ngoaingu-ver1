@extends('admin.layouts.master')
@section('title')
Cập nhật
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Trang <small
            style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Cập nhật</small></h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form role="form" method="POST" action="{{ route('trang.update', $trang->id) }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{ $trang->id }}">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tiêu đề <span class="text-danger">(*)</span></label>
                                <input class="form-control" name="title" placeholder="Nhập tiêu đề trang"
                                    value="{{ $trang->title }}">
                                @if($errors->has('title'))
                                <div class="text-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description" cols="3" rows="3" class="form-control"
                                    placeholder="Nhập mô tả">{{ $trang->description }}</textarea>
                                @if($errors->has('description'))
                                <div class="text-danger">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="image">Ảnh minh họa <span class="text-danger">(*)</span></label>
                                <p>
                                    <img width="150px" src="img/upload/trang/{{ $trang->image }}">
                                </p>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nội dung <span class="text-danger">(*)</span></label>
                                <textarea id="my-editor" name="content" cols="5" rows="5"
                                    class="form-control">{{ $trang->content }}</textarea>
                                @if($errors->has('content'))
                                <div class="text-danger">{{ $errors->first('content') }}</div>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control" name="status">
                                    <option @if ($trang->status==1)
                                        {{ "selected" }}
                        @endif
                        value="1">Hiển thị</option>
                        <option @if ($trang->status==0)
                            {{ "selected" }}
                            @endif
                            value="0">Không hiển thị</option>
                        </select>
                    </div> --}}
                </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <a href="{{ route('trang.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"
                    aria-hidden="true"></i> Trở về</a>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
        </div>
        </form>
    </div>
</div>

</div>
@endsection