@extends('admin.layouts.master')
@section('title')
Danh sách
@endsection
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Liên hệ <small
      style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Danh sách</small></h1>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      {{-- <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('giangvien.create') }}" class="btn btn-success"><i
            class="fa fa-plus"></i> Thêm mới</a></h6> --}}
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th>Họ tên</th>
              <th>Số điện thoại</th>
              <th>Địa chỉ</th>
              <th>Email</th>
              <th>Nội dung</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($lienhe as $key => $value)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $value->fullname }}</td>
              <td>{{ $value->email }}</td>
              <td>{{ $value->content }}</td>
              <td>{{ $value->phone }}</td>
              <td>{{ $value->address }}</td>
              <td>
                <a class="btn btn-danger iconactive" title="{{ "Xóa " .$value->fullname }}"
                  onclick="return confirm('Bạn có muốn xóa {{ $value->fullname }} không?');"
                  href="{{ route('lienhe.destroy',$value->id) }}" ​><i class="fa fa-trash"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>STT</th>
              <th>Họ tên</th>
              <th>Số điện thoại</th>
              <th>Địa chỉ</th>
              <th>Email</th>
              <th>Nội dung</th>
              <th>Hành động</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection