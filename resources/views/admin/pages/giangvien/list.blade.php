@extends('admin.layouts.master')
@section('title')
Danh sách
@endsection
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Giảng viên <small
      style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Danh sách</small></h1>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('giangvien.create') }}" class="btn btn-success"><i
            class="fa fa-plus"></i> Thêm mới</a></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th>Mã SV</th>
              <th>Họ tên</th>
              <th style="width: 76px;">Ngày sinh</th>
              <th style="width: 63px;">Giới tính</th>
              {{-- <th style="width: 62px;">Trình độ</th> --}}
              <th>Môn học</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($giangvien as $key => $value)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $value->magv }}</td>
              <td>
                <p>{{ $value->fullname }}</p>
                <img src="img/upload/avatar/{{ $value->avatar }}" width="100" alt="">
              </td>
              <td>{{ \Carbon\Carbon::parse($value->birthday)->format('d-m-Y')}}</td>
              <td>
                @if ($value->sex==0)
                {{ "Nam" }}
                @else
                {{ "Nữ" }}
                @endif
              </td>
              {{-- <td>{{ $value->TrinhDo->name }}</td> --}}
              <td> @foreach ($value->MonHoc as $mh)
                {{ $mh->name }}<br>
              @endforeach</td>
              <td>
                <a class="btn btn-primary iconactive" title="{{ "Sửa " .$value->fullname }}"
                  href="{{ route('giangvien.edit',$value->id) }}" ​><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger iconactive" title="{{ "Xóa " .$value->fullname }}"
                  onclick="return confirm('Bạn có muốn xóa {{ $value->fullname }} không?');"
                  href="{{ route('giangvien.destroy',$value->id) }}" ​><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>STT</th>
              <th>Mã SV</th>
              <th>Họ tên</th>
              <th>Ngày sinh</th>
              <th>Giới tính</th>
              {{-- <th>Trình độ</th> --}}
              <th>Môn học</th>
              <th>Hành động</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection