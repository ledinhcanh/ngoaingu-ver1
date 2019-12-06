@extends('admin.layouts.master')
@section('title')
Cập nhật
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lớp
            <small>Cập nhật</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="admin"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('lop.index') }}">Lớp</a></li>
            <li class="active">Cập nhật</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('lop.update', $lop->id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ $lop->id }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Tên lớp</label>
                                <input class="form-control" name="name" placeholder="Nhập tên lớp"
                                    value="{{ $lop->name }}" />
                                @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                
                            <div class="form-group">
                                <label>Tên chuyên ngành</label>
                                <select class="form-control" name="idchuyennganh">
                                    @foreach ($chuyennganh as $cn)
                                    <option @if ($lop->idchuyennganh == $cn->id)
                                        {{"selected"}}
                                        @endif
                                        value="{{ $cn->id }}">{{ $cn->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                            <a href="{{ route('lop.index') }}" class="btn btn-primary">Trở về</a>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection