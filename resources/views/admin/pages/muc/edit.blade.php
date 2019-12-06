@extends('admin.layouts.master')
@section('title')
Cập nhật
@endsection

@section('content')
<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Mục <small style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Cập nhật</small></h1>
          

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
               <form role="form" method="POST" action="{{ route('muc.update', $muc->id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ $muc->id }}">
                        <div class="box-body">
                            <div class="form-group col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label>Tên mục <span class="text-danger">(*)</span></label>
                                <input class="form-control" name="name" placeholder="Nhập tên mục"
                                    value="{{ $muc->name }}" />
                                @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer" style="margin-left: 16px;">
                            <a href="{{ route('muc.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Trở về</a>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                        </div>
                    </form>
            </div>
          </div>

        </div>
@endsection