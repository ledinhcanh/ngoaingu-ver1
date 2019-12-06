@extends('admin.layouts.master')
@section('title')
Cập nhật
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Bài viết <small
            style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Cập nhật</small></h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form role="form" method="POST" action="{{ route('baiviet.update', $baiviet->id) }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{ $baiviet->id }}">
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
                                            <option @if ($baiviet->chuyenmuc->muc->name==$m->name)
                                                {{ "selected" }}
                                                @endif
                                                value="{{ $m->id }}">{{ $m->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tên chuyên mục</label>
                                        <select class="form-control idchuyenmuc" name="idchuyenmuc">
                                            <option value="{{ $baiviet->ChuyenMuc->id }}">
                                                {{ $baiviet->ChuyenMuc->name }}
                                            </option>
                                        </select>
                                        @if($errors->has('idchuyenmuc'))
                                        <div class="text-danger">{{ $errors->first('idchuyenmuc') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="title" placeholder="Nhập tiêu đề bài viết"
                                    value="{{ $baiviet->title }}">
                                @if($errors->has('title'))
                                <div class="text-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="image">Ảnh minh họa</label>
                                <p><img width="205px" src="img/upload/baiviet/{{ $baiviet->image }}"></p>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" style="margin-top: -33px">
                                <label>Mô tả</label>
                                <textarea class="form-control" rows="5"
                                    name="description">{{ $baiviet->description }}</textarea>
                                @if($errors->has('description'))
                                <div class="text-danger">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tin theo dòng</label>
                                <select name="tintheodong[]" multiple id="tintheodong" class="form-control"
                                    style="height: 100px !important;">
                                    @foreach($tintheodong as $ttd)
                                    <option {{ $list->contains($ttd->id) ? 'selected' : '' }} value="{{ $ttd->id}}">
                                        {{ $ttd->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="my-editor" name="content" cols="5" rows="5"
                                    class="form-control">{{ $baiviet->content }}</textarea>
                                @if($errors->has('content'))
                                <div class="text-danger">{{ $errors->first('content') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                                <label>Nổi bật</label>
                                <select class="form-control" name="highlight">
                                    <option @if ($baiviet->highlight==1)
                                        {{ "selected" }}
                    @endif
                    value="1">Có</option>
                    <option @if ($baiviet->highlight==0)
                        {{ "selected" }}
                        @endif
                        value="0">Không</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <select class="form-control" name="status">
                        <option @if ($baiviet->status==1)
                            {{ "selected" }}
                            @endif
                            value="1">Hiển thị</option>
                        <option @if ($baiviet->status==0)
                            {{ "selected" }}
                            @endif
                            value="0">Không hiển thị</option>
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