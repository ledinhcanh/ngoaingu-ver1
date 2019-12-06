@extends('admin.layouts.master')
@section('title')
Danh sách
@endsection
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Mục <small
      style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Danh sách</small></h1>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('lich.create') }}" class="btn btn-success"><i
            class="fa fa-plus"></i> Thêm mới</a></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên tiêu đề</th>
              <th>Màu</th>
              <th>Ngày bắt đầu</th>
              <th>Ngày kết thúc</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>STT</th>
              <th>Tên tiêu đề</th>
              <th>Màu</th>
              <th>Ngày bắt đầu</th>
              <th>Ngày kết thúc</th>
              <th>Hành động</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($lich as $key => $value)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $value->title }}</td>
              <td>{{ $value->color }}</td>
              <td>{{ \Carbon\Carbon::parse($value->start_date)->format('d-m-Y')}}</td>
              <td>{{ \Carbon\Carbon::parse($value->end_date)->format('d-m-Y')}}</td>
              <td>
                <a class="btn btn-primary iconactive" title="{{ "Sửa " .$value->title }}" href="{{ route('lich.edit',$value->id) }}"
                  ​><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger iconactive" title="{{ "Xóa " .$value->title }}"
                  onclick="return confirm('Bạn có muốn xóa {{ $value->title }} không?');"
                  href="{{ route('lich.destroy',$value->id) }}" ​><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection