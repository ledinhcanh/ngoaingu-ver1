@extends('client.layouts.master')
@section('title')
Thảo luận
@endsection
@section('content')
{{-- <section class="hero-wrap hero-wrap-2" style="background-image: url('assets/client/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h2 class="mb-4 bread">Thảo luận</h2>
                <p class="breadcrumbs text-center"><span class="mr-2"><a href="/">Trang chủ <i
                                class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2">Thảo luận</span></p>
            </div>
        </div>
    </div>
</section> --}}
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <form method="get" action="tim-kiem-bai">
                    <div class="form-group">
                        <input type="text" name="key" class="form-control" placeholder="Tìm kiếm">
                    </div>
                </form>
                @if (Auth::check())
                <a class="btn btn-primary btn-block" href="{{ route('thaoluan.create')}}"
                    style="border-radius: 3px;padding: 10px;"><i class="fa fa-plus-square pr-2"
                        aria-hidden="true"></i>Tạo bài viết</a><br>
                @else
                <a class="btn btn-primary btn-block" href="#exampleModal" style="border-radius: 3px;padding: 10px;"
                    data-toggle="modal"><i class="fa fa-plus-square pr-2" aria-hidden="true"></i>Tạo bài viết</a><br>
                @endif

                <h4>Thể loại</h4>
                <ul class="list-group" style="box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);">
                    <a href="{{ route('thaoluan.index') }}" class="list-group-item" style="color:#333;">
                        <span class="badge"></span>
                        Tất cả
                    </a>
                    @foreach($tags as $tag)
                    <a href="{{ route('thaoluan.index',['tags' => $tag->id]) }}" class="list-group-item" style="color:#333;">
                        <span class="badge"></span>
                        {{ $tag->name }}
                    </a>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9">
                @yield('thaoluan')
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" id="form-edit">
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Bình luận</label>
                        <textarea name="content" class="form-control content" id="" cols="30" rows="7"></textarea>
                        {{-- <input type="text" class="form-control content" name="content" placeholder="Nhập bình luận"> --}}
                        <span class="error" style="color:red"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary update">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection