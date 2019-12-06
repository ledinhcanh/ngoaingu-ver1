@extends('admin.layouts.master')
@section('title')
Thêm mới
@endsection

@section('content')
<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Chuyên mục <small style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Thêm mới</small></h1>
          

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
               <form role="form" method="POST" action="{{ route('chuyenmuc.store') }}">
                        @csrf
                        <div class="box-body">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tên chuyên mục <span class="text-danger">(*)</span></label>
                                    <input class="form-control" name="name" placeholder="Nhập tên chuyên mục" />
                                    @if ($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                    
                                    {{-- <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Không hiểu thị</option>
                                        </select>
                                    </div> --}}
                            
                                <div class="form-group">
                                    <label>Tên mục</label>
                                    <select class="form-control" name="idmuc">
                                        @foreach ($muc as $m)
                                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer" style="margin-left: 16px;">
                            <a href="{{ route('chuyenmuc.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Trở về</a>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
                        </div>
                    </form>
            </div>
          </div>

        </div>
@endsection