@extends('admin.layouts.master')
@section('title')
Danh sách
@endsection
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Tài liệu <small
      style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Danh sách</small></h1>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('tailieu.create') }}" class="btn btn-success"><i
            class="fa fa-plus"></i> Thêm mới</a></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th style="width: 160px;">Tên tài liệu</th>
              <th style="width: 160px;">Mô tả</th>
              <th>Định dạng</th>
              {{-- <th>Tác giả</th> --}}
              <th>Loại tài liệu</th>
              <th>Ngôn ngữ</th>
              <th>Nhà xuất bản</th>
              <th style="width: 150px;">Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tailieu as $key => $tl)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>
                <p>{{ $value->name }}</p>
                <img src="img/upload/tailieu/{{ $value->image}}" width="100" alt="">
              </td>
              <td>
                @if ($value->description)
                {{ $value->description }}
                @endif
              </td>
              <td>{{ $value->format }}</td>
              <td>{{ $value->LoaiTaiLieu->name }}</td>
              <td>{{ $value->NgonNgu->name }}</td>
              <td>{{ $value->NhaXuatBan->name }}</td>
              <td>
                {!! download_file('file/', $value->file, null, null, null) !!}
                <a class="btn btn-primary iconactive" title="{{ "Sửa " .$value->name }}"
                  href="{{ route('tailieu.edit',$value->id) }}" ​><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger iconactive" title="{{ "Xóa " .$value->title }}"
                  onclick="return confirm('Bạn có muốn xóa {{ $value->name }} không?');"
                  href="{{ route('tailieu.destroy',$value->id) }}" ​><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>STT</th>
              <th>Tên tài liệu</th>
              <th>Mô tả</th>
              <th>Định dạng</th>
              {{-- <th>Tác giả</th> --}}
              <th>Loại tài liệu</th>
              <th>Ngôn ngữ</th>
              <th>Nhà xuất bản</th>
              <th>Hành động</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection