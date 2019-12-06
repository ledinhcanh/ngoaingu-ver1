@extends('admin.layouts.master')
@section('title')
Cập nhật
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Chương trình đào tạo <small
            style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Cập nhật</small></h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form role="form" method="POST" action="{{ route('ctdaotao.update', $hocphan->id) }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tên học phần <span class="text-danger">(*)</span></label>
                                <input class="form-control" name="name" value="{{ $hocphan->name }}" placeholder="Nhập tên môn học" />
                                @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Mã học phần <span class="text-danger">(*)</span></label>
                                <input class="form-control" name="code" placeholder="Nhập mã học phần" value="{{ $hocphan->code }}"/>
                                @if ($errors->has('code'))
                                <div class="text-danger">{{ $errors->first('code') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Số tín chỉ <span class="text-danger">(*)</span></label>
                                <input type="number" class="form-control" name="number" placeholder="Nhập số tín chỉ" value="{{ $hocphan->number }}" />
                                @if ($errors->has('number'))
                                <div class="text-danger">{{ $errors->first('number') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Học kì<span class="text-danger">(*)</span></label>
                                <select class="form-control" name="idhocki">
                                    <option value="">----- Học kì -----</option>
                                    @foreach($hocki as $hk)
                                    <option @if ($hocphan->HocKi->name==$hk->name)
                                        {{ "selected" }} @endif value="{{ $hk->id }}">{{ $hk->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chuyên ngành<span class="text-danger">(*)</span></label>
                                <select class="form-control" name="idchuyennganh">
                                    <option value="">----- Chuyên ngành -----</option>
                                    @foreach($chuyennganh as $cn)
                                    <option @if ($hocphan->ChuyenNganh->name==$cn->name)
                                        {{ "selected" }} @endif value="{{ $cn->id }}">{{ $cn->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Tài liệu <span class="text-danger">(*)</span></label>
                                <select name="tailieu[]" multiple id="tailieu" class="form-control"
                                    style="height: 300px !important;">
                                    @foreach($tailieu as $tl)
                                    <option {{ $list->contains($tl->id) ? 'selected' : '' }} value="{{$tl->id}}">{{$tl->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{ route('ctdaotao.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i> Trở về</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection