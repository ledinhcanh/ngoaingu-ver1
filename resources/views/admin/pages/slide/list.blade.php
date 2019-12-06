@extends('admin.layouts.master')
@section('title')
Danh sách
@endsection
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Slide <small
      style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Danh sách</small></h1>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('slide.create') }}" class="btn btn-success"><i
            class="fa fa-plus"></i> Thêm mới</a></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên slide</th>
              <th>Hình ảnh</th>
              <th>Nội dung</th>
              <th>Trạng thái</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($slide as $key => $value)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $value->name }}</td>
              <td> <img src="img/upload/slide/{{ $value->image }}" width="200" alt=""></td>
              <td>{{ $value->content}}</td>
              <td>
                <a href="{{ route('slide.show',$value->id) }}"
                  class="btn {{ $value->getStatus($value->status)['class'] }}"
                  style="padding: 4px;border: none;font-size: 13px;">{{ $value->getStatus($value->status)['name'] }}</a>
              <td>
                <a class="btn btn-primary iconactive" title="{{ "Sửa " .$value->name }}"
                  href="{{ route('slide.edit',$value->id) }}" ​><i class="fa fa-edit"></i></a>
                  <a class="btn btn-danger iconactive" title="{{ "Xóa " .$value->name }}"
                    onclick="return confirm('Bạn có muốn xóa {{ $value->name }} không?');"
                    href="{{ route('slide.destroy',$value->id) }}" ​><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>STT</th>
              <th>Tên slide</th>
              <th>Hình ảnh</th>
              <th>Nội dung</th>
              <th>Trạng thái</th>
              <th>Hành động</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection