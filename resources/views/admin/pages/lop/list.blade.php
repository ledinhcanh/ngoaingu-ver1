@extends('admin.layouts.master')
@section('title')
Danh sách
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Lớp
            <small>Danh sách</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="admin"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('lop.index') }}">Lớp</a></li>
            <li class="active">Danh sách</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="{{ route('lop.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Thêm mới</a>
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Lớp</th>
                                    <th>Chuyên ngành</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lop as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->ChuyenNganh->name }}</td>
                                    <td>
                                        <a class="btn btn-primary" title="{{ "Sửa " .$value->name }}" href="{{ route('lop.edit',$value->id) }}"​><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger delete" title="{{ "Xóa " .$value->name }}" type="button" data-url="{{ route('lop.destroy',$value->id) }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Lớp</th>
                                    <th>Chuyên ngành</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    <!-- delete Modal-->

<div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Thông báo</h3>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Bạn có muốn xóa không ?</h4>
                </div>
                <div class="modal-footer">
                 <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection