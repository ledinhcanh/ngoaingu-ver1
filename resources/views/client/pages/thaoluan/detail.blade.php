@extends('client.pages.thaoluan')
@section('thaoluan')
<div>
    <h2 class="mb-3" style="overflow-wrap: break-word;">{{ $thaoluan->title }}</h2>
    <div class="p-4 bg-light post" style="position: relative;">
        @if (Auth::check())
        @if (Auth::user()->id == $thaoluan->TaiKhoan->id)
        <div class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"
                style="padding: 0px;text-align: right;color: #333;position: absolute;top: -7px;right: 0px;font-size: 23px;">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown"
                style="padding: 0;
        margin: 0;">
                <a class="dropdown-item" href="{{ route('thaoluan.edit', $thaoluan->id) }}" style="color: #333;">
                    <i class="fa fa-pencil pr-3" aria-hidden="true"></i>
                    Edit
                </a>
                <div class="dropdown-divider" style="margin: 0"></div>
                <a class="dropdown-item" href="{{ route('thaoluan.destroy', $thaoluan->id) }}"
                    onclick="return confirm('Bạn có muốn xóa không?');" style="color: #333;">
                    <i class="fa fa-trash-o pr-3" aria-hidden="true"></i>
                    Delete
                </a>
            </div>
            </span>
        </div>
        @endif
        @endif

        <div class="vcard bio" style="width: 62px;">
            <img src="img/upload/avatar/{{ ($thaoluan->TaiKhoan->idquyenhan == '4' ) ? $sinhvien->avatar : (($thaoluan->TaiKhoan->idquyenhan == '3' ) ? $giangvien->avatar : 'no-avatar.jpg') }}"
                alt="Image placeholder" style="border: 1px solid rgba(0, 0, 0, .1);height: 50px;">
        </div>
        <div class="comment-body" style="color: #333;overflow-wrap: break-word;">
            <h3 style="font-size: 21px;">{{ $thaoluan->TaiKhoan->display_name }}</h3>
            <div class="meta mb-2" style="margin-top: -9px;font-size: 12px;">{{$thaoluan->created_at->diffForHumans()}}
            </div>
            <p>{!! $thaoluan->content !!}</p>
            @if ($thaoluan->file)
            @if ($thaoluan->format == 'image/jpeg' || $thaoluan->format == 'image/png' || $thaoluan->format == 'image/jpg')
                <p><img src="file/thaoluan/{{ $thaoluan->file }}" style="width:250px;" alt=""></p>
            @else
                <p><i class="fa fa-file-text pr-2" aria-hidden="true" style="font-size: 24px;"></i><a href="file/thaoluan/{{ $thaoluan->file }}" download="{{ $thaoluan->file }}" style="color: #666666">{{ $thaoluan->file }}<i class="fa fa-download pl-2" aria-hidden="true"></i></a></p>
            @endif
            @endif
        </div>
    </div>
    <div class="pt-2 mt-2">
        <h3 class="mb-4 h4 font-weight-bold float-left" style="font-size: 21px;">{{ $thaoluan->BinhLuan->count() }}
            bình luận</h3>
        <ul class="comment-list">
            @foreach ($thaoluan->BinhLuan as $bl)

            <li class="comment" style="margin-bottom: 15px;">
                <div class="vcard bio" style="width: 62px;">
                    <img src="img/upload/avatar/{{ ($bl->TaiKhoan->idquyenhan == '4' ) ? $bl->TaiKhoan->SinhVien->avatar : (($bl->TaiKhoan->idquyenhan == '3') ? $bl->TaiKhoan->GiangVien->avatar : 'no-avatar.jpg') }}"
                        alt="Image placeholder" style="border: 1px solid rgba(0, 0, 0, .1);">
                </div>
                <div class="comment-body" style="width: 92%;">
                    <h3 style="margin-bottom: 0;text-align: justify;">
                        <span
                            style="font-weight: bold;">{{ ($bl->TaiKhoan->idquyenhan == '4' ) ? $bl->TaiKhoan->SinhVien->fullname : (($bl->TaiKhoan->idquyenhan == '4' ) ? $bl->TaiKhoan->GiangVien->fullname : $bl->TaiKhoan->display_name) }}</span>
                        <span class="ml-2" style="text-transform: none; color:#333;">{{ $bl->content }}</span></h3>

                    <span class="meta pr-2"
                        style="text-transform: none;font-size: 12px;">{{ $bl->created_at->diffForHumans()}}</span>
                    @if (Auth::check())
                    @if (Auth::user()->id == $bl->TaiKhoan->id)
                    <span class="pr-2"><a href="#" style="color: #5b5757;font-size: 14px;" data-id="{{ $bl->id }}" ​
                            data-target="#edit" data-toggle="modal" class="editbinhluan"><i class="fa fa-pencil pr-1"
                                aria-hidden="true"></i>Edit</a>
                    </span><span><a href="{{ route('binhluan.destroy', $bl->id) }}"
                            onclick="return confirm('Bạn có muốn xóa không?');"
                            style="color: #5b5757;font-size: 14px;"><i class="fa fa-trash-o pr-1"
                                aria-hidden="true"></i>Delete</a>
                    </span>
                    @endif
                    @endif
                    <!-- <p><a href="#" class="reply">Reply</a></p> -->
                </div>

            </li>
            @endforeach
        </ul>
        @if (Auth::check())
        <div class="comment-form">
            <form action="{{ route('binhluan.create', $thaoluan->id) }}" method="post" role="form">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="content" id="" placeholder="Bình luận..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="float: right; border-radius: 4px;">Gửi bình luận</button>
            </form>
        </div>
        @else
        <div class="form-group">
            <textarea class="form-control" name="content" id="" placeholder="Bình luận..."></textarea>
        </div>
        <button data-target="#exampleModal" data-toggle="modal" class="btn btn-primary"
            style="float: right; border-radius: 4px;">Comment</button>
        @endif
        <!-- END comment-list -->
    </div>
</div>

@endsection