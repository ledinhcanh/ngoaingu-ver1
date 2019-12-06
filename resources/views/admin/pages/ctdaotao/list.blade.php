@extends('admin.layouts.master')
@section('title')
Danh sách
@endsection
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Chương trình đào tạo <small
      style="font-size: 15px;display: inline-block;padding-left: 4px;font-weight: 300;"> Danh sách</small></h1>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('ctdaotao.create') }}" class="btn btn-success"><i
            class="fa fa-plus"></i> Thêm mới</a></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên môn học</th>
              <th>Học kì</th>
              <th>Chuyên ngành</th>
              <th>Tài liệu</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dsmonhoc as $key => $value)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $value->name }}</td>
              <td>{{ $value->HocKi->name }}</td>
              <td>{{ $value->ChuyenNganh->name }}</td>
              <td> @foreach ($value->TaiLieu as $tl)
                {{ $tl->name }}<br>
                @endforeach</td>
              <td>
                <a class="btn btn-primary iconactive" title="{{ "Sửa " .$value->name }}"
                  href="{{ route('ctdaotao.edit',$value->id) }}" ​><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger iconactive" title="{{ "Xóa " .$value->name }}"
                  onclick="return confirm('Bạn có muốn xóa {{ $value->name }} không?');"
                  href="{{ route('ctdaotao.destroy',$value->id) }}" ​><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>STT</th>
              <th>Tên môn học</th>
              <th>Học kì</th>
              <th>Chuyên ngành</th>
              <th>Tài liệu</th>
              <th>Hành động</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection