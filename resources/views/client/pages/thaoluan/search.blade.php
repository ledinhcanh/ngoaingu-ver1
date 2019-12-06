@extends('client.pages.thaoluan')
@section('thaoluan')
<div class="list-group">
    @if(Session::has('thongbaotl'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{!! session('thongbaotl') !!}</strong>
    </div>
    @endif
    @if(count($thaoluan) > 0)
    <div class="alert alert-primary" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Từ khóa <strong>{{ $keyword }}</strong> có <strong>{{ count($thaoluan) }}</strong> kết quả
    </div>
    @else
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Từ khóa <strong>{{ $keyword }}</strong> không tìm thấy tin tức nào
    </div>
    @endif
    @foreach($thaoluan as $tl)
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title"><a style="color: #fff; font-size: 17px;"
                    href="{{ route('thaoluan.detail', $tl->id) }}">{{ $tl->title }}</a></h5>
        </div>
        <div class="panel-body" style="padding: 0 15px;">
            <span class="thaoluan">{!! str_limit($tl->content,100) !!}</span>
            <p style="margin-bottom: 0px;">Tạo bởi
                <a href="{{ route('profile1.index', $tl->TaiKhoan->id) }}">{{ $tl->TaiKhoan->display_name }}</a>
                {{$tl->created_at->diffForHumans()}} | {{ $tl->view }} lượt xem | {{ $tl->BinhLuan->count() }} bình luận
            </p>
        </div>
    </div>
    @endforeach

</div>
<div class="float-right">{{ $thaoluan->links() }}</div>
@endsection