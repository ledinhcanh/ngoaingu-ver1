@extends('admin.layouts.master')
@section('title')
Trang chủ
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thống kê</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col ml-4">
              <i class="fas fa-clipboard-list fa-2x text-gray-300" style="font-size: 45px;"></i>
            </div>
            <div class="mr-5">
              <div class="h5 font-weight-bold text-primary mb-1">Số bài viết</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" style="margin-left: 40%;">{{ $baiviet->count() }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col ml-2">
              <i class="fas fa-book-open fa-2x text-gray-300" style="font-size: 45px;"></i>
            </div>
            <div class="mr-4">
              <div class="h5 font-weight-bold text-primary mb-1">Số bài thảo luận</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" style="margin-left: 40%;">{{ $baithaoluan->count() }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col ml-2">
              <i class="fas fa-comments fa-2x text-gray-300" style="font-size: 45px;"></i>
            </div>
            <div class="mr-4">
              <div class="h5 font-weight-bold text-primary mb-1">Số bình luận</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" style="margin-left: 40%;">{{ $binhluan->count() }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col ml-4">
              <i class="fas fa-file-pdf fa-2x text-gray-300" style="font-size: 45px;"></i>
            </div>
            <div class="mr-5">
              <div class="h5 font-weight-bold text-primary mb-1">Số tài liệu</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" style="margin-left: 40%;">{{ $tailieu->count() }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- Content Row -->

  <!-- Content Row -->
  <div class="row">
    <div class="col-sm-12">
      <h1 class="h3 mb-4 mt-3 text-gray-800">Bài chưa duyệt</h1>
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>STT</th>
                  <th style="width: 170px;">Tiêu đề</th>
                  <th style="width: 300px;">Nội dung</th>
                  <th>Trạng thái</th>
                  <th>Tài khoản</th>
                  <th>Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($thaoluan as $key => $value)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $value->title }}</td>
                  <td>{!! $value->content !!}</td>
                  <td>
                    <a href="{{ route('baithaoluan.show',$value->id) }}"
                      class="btn {{ $value->getStatus($value->status)['class'] }}"
                      style="padding: 4px;border: none;font-size: 13px;">{{ $value->getStatus($value->status)['name'] }}</a>
                  </td>
                  <td>{{ $value->TaiKhoan->display_name }}</td>

                  {{-- <a class="btn btn-primary iconactive" title="{{ "Sửa " .$value->name }}"
                  href="{{ route('chuyenmuc.edit',$value->id) }}" ​><i class="fa fa-edit"></i></a> --}}
                  {{-- </td> --}}
                  <td>
                    <a class="btn btn-danger iconactive" title="{{ "Xóa " .$value->name }}"
                      onclick="return confirm('Bạn có muốn xóa {{ $value->title }} không?');"
                      href="{{ route('baithaoluan.destroy',$value->id) }}" ​><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>STT</th>
                  <th>Tiêu đề</th>
                  <th>Nội dung</th>
                  <th>Trạng thái</th>
                  <th>Tài khoản</th>
                  <th>Hành động</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <div style="float:right">{{ $thaoluan->links() }}</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection