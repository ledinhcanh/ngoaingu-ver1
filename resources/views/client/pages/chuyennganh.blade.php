@extends('client.layouts.master')
@section('title')
Chuyên ngành
@endsection
@section('css')
<style type="text/css">
    .color>p {
        color: #000000;
    }

    #hocphan {
        display: none;
    }
</style>
@endsection
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('assets/client/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h2 class="mb-4 bread">{{ $chuyenmuc1->name }}</h2>
                <p class="breadcrumbs text-center"><span class="mr-2"><a href="/">Trang chủ <i
                                class="ion-ios-arrow-forward"></i></a></span> <span>Chuyên ngành</span></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ftco-animate color eimg" style="color: #000000;text-align: justify;">
                <div class="fb-like mb-3" data-href="http://127.0.0.1:8000/chuyen-nganh/{{ $chuyennganh->slug }}"
                    data-width="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true"
                    data-share="true"></div>
                @if (count((array)($chuyennganh))>0)
                {!! $chuyennganh->content !!}
                @endif
                <p><b style="text-align: inherit;">HỌC KÌ I </b><button onclick="myFunction()" class="ml-2" style="border: none;">Xem chi tiết</button> </p>
                {{-- @foreach ($hocki as $key => $hk)
                <b style="text-transform: uppercase;">{{ $hk->name }}</b><br> --}}
                <div id="hocphan">
                    @foreach ($hocphan as $key => $hp)
                    @if ($hp->HocKi->id == 1)
                    <div>{{ $key+1 }}. {{ $hp->name }} ({{ $hp->code }} - {{ $hp->number }}TC)</div>
                    <div class="ml-3">Tài liệu tham khảo:</div>
                    @foreach ($hp->TaiLieu as $tl)
                    <div class="ml-3">{{ $tl->name }}: <a href="tai-lieu/{{ $tl->slug }}"
                            style="color: #000000;border-radius: 0;padding: 1px 7px 1px 7px;"
                            class="btn btn-success btn-sm">Chi tiết</a> {!! download_tl('file/', $tl->file, null, null,
                        null) !!}</div>
                    @endforeach
                    @endif
                    @endforeach
                </div>
                {{-- @endforeach --}}
                <div class="fb-comments" data-href="http://127.0.0.1:8000/chuyen-nganh/{{ $chuyennganh->slug }}"
                    data-width="730" data-numposts="5" style=""></div>
            </div> <!-- .col-md-8 -->

            <div class="col-lg-4 sidebar ftco-animate">
                <div class="sidebar-box ftco-animate" style="position: relative;">
                    <h3 style="font-size: 20px;font-weight: 700;">Bài viết mới nhất</h3>
                    @foreach ($baiviet as $bv)
                    <div class="block-21 mb-2 d-flex" style="border-bottom: 1px dashed #ddd; padding-bottom: 13px;">
                        <a class="blog-img mr-3 mt-1"
                            style="background-image: url(img/upload/baiviet/{{ $bv->image }});"></a>
                        <div class="text">
                            <h3 class="heading mb-1" style="text-align: justify; font-size: 16px;"><a
                                    href="tin/{{ $bv->slug }}">{{ $bv->title }}</a></h3>
                            <div class="meta pt-1">
                                <div><a href="#" style="font-size: 14px;"><span class="icon-calendar"></span>
                                        {{ \Carbon\Carbon::parse($bv->updated_at)->format('d/m/Y')}}</a></div>
                                {{-- <div><a href="#"><span class="icon-person"></span> Admin</a></div> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="sidebar-box ftco-animate">
                    <h3 style="font-size: 20px;font-weight: 700;">Thông báo</h3>
                    @foreach ($thongbao as $tb)
                    <div class="block-21 mb-2 d-flex" style="border-bottom: 1px dashed #ddd; padding-bottom: 13px;">
                        <a class="blog-img mr-3 mt-1"
                            style="background-image: url(img/upload/baiviet/{{ $tb->image }});"></a>
                        <div class="text">
                            <h3 class="heading mb-1" style="text-align: justify; font-size: 16px;"><a
                                    href="tin/{{ $tb->slug }}">{{ $tb->title }}</a></h3>
                            <div class="meta pt-1">
                                <div style="font-size: 14px;"><span class="icon-calendar"></span>
                                    {{ \Carbon\Carbon::parse($tb->updated_at)->format('d/m/Y')}}</div>
                                {{-- <div><a href="#"><span class="icon-person"></span> Admin</a></div> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div><!-- END COL -->
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
    function myFunction() {
      var x = document.getElementById('hocphan');
      if (x.style.display === '' || x.style.display === 'none') {
          x.style.display = 'unset';
      } else {
          x.style.display = 'none';
      }
    }
</script>
@endsection