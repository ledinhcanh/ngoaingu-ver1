@extends('admin.layouts.master')
@section('title')
Danh sách
@endsection
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Bài viết <small
      style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Danh sách</small></h1>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('baiviet.create') }}" class="btn btn-success"><i
            class="fa fa-plus"></i> Thêm mới</a></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th style="width: 90px;">Tiêu đề</th>
              <th >Mô tả</th>
              <th style="width: 96px;">Chuyên mục</th>
              <th style="width: 90px;">Trạng thái</th>
              <th style="width: 80px;">Nổi bật</th>
              {{-- <th>View</th> --}}
              <th style="width: 120px;">Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($baiviet as $key => $value)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>
                <p>{{ $value->title }}</p>
                <img src="img/upload/baiviet/{{ $value->image }}" width="100" alt="">
              </td>
              <td style="text-align: justify;">{{ $value->description }}</td>
              {{-- <td>{{ $value->ChuyenMuc->Muc->name }}</td> --}}
              <td>{{ $value->ChuyenMuc->name }}</td>
              <td>
                <a href="{{ route('baiviet.action',['status',$value->id]) }}"
                  class="btn {{ $value->getStatus($value->status)['class'] }}"
                  style="padding: 4px;border: none;font-size: 13px;">{{ $value->getStatus($value->status)['name'] }}</a>
              </td>
              <td>
                <a href="{{ route('baiviet.action',['hl',$value->id]) }}"
                  class="btn {{ $value->getHL($value->highlight)['class'] }}"
                  style="padding: 4px;border: none;font-size: 13px;">{{ $value->getHL($value->highlight)['name'] }}</a>
              </td>
              {{-- <td>{{ $value->view }}</td> --}}
              <td>
                <a href="#edit{{ $value->id }}" data-toggle="modal" class="btn btn-success iconactive"><i class="fas fa-eye"></i></a>
                <a class="btn btn-primary iconactive" title="{{ "Sửa " .$value->title }}"
                  href="{{ route('baiviet.edit',$value->id) }}" ​><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger iconactive" title="{{ "Xóa " .$value->title }}"
                  href="{{ route('baiviet.destroy',$value->id) }}"
                  onclick="return confirm('Bạn có muốn xóa {{ $value->title}} không?');"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            <div class="modal fade" id="edit{{ $value->id }}" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin chi tiết<span class="title"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p><b>ID</b>: {{ $value->id }}</p>
                    <p><b>Tiêu đề:</b> {{ $value->title }}</p>
                    <p><b>Hình ảnh:</b> <img src="img/upload/baiviet/{{ $value->image }}" width="200" alt=""></p>
                    <p><b>Mô tả</b>: {{ $value->description }}</p>
                    <p><b>Chuyên mục:</b> {{ $value->ChuyenMuc->name }}</p>
                    <p><b>Số lượt xem:</b> {{ $value->view }} lượt xem</p>
                    {{-- <p><b>Nội dung:</b> {!! $value->content !!}</p> --}}
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>STT</th>
              <th>Tiêu đề</th>
              <th>Mô tả</th>
              <th>Chuyên mục</th>
              <th>Trạng thái</th>
              <th>Nổi bật</th>
              {{-- <th>View</th> --}}
              <th>Hành động</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection