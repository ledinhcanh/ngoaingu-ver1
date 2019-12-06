<div class="topheader">
    <div class="container">
        <div class="float-right" style="height: 28px;">
            @if (Auth::check())
            <div class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" style="padding: 0px;text-align: right;color:#fff;">
                    <span class="mr-2 d-none d-lg-inline text-gray-600">
                        @if (Auth::user()->QuyenHan->id == '3')
                        {{ Auth::user()->GiangVien->fullname }}
                        @elseif(Auth::user()->QuyenHan->id == '4')
                        {{ Auth::user()->SinhVien->fullname }}
                        @else
                        {{ Auth::user()->display_name }}
                        @endif</span>
                    <img class="img-profile rounded-circle"
                        style="margin-bottom: 3px;border: 1px solid rgba(0, 0, 0, .1);width: 28px; height: 28px;"
                        src="img/upload/avatar/{{ (Auth::user()->QuyenHan->id == '4' ) ? Auth::user()->SinhVien->avatar : ((Auth::user()->QuyenHan->id == '3') ? Auth::user()->GiangVien->avatar : 'no-avatar.jpg') }}"
                        style="margin-bottom: 1px;">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    @if(Auth::user()->QuyenHan->id > '2')
                    <a class="dropdown-item"
                        href="{{ route('profile.index', (Auth::user()->QuyenHan->id == '3' ) ? Auth::user()->GiangVien->magv : Auth::user()->SinhVien->masv) }}"
                        style="color: #333;">
                        <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Trang cá nhân
                        <div class="dropdown-divider"></div>
                    </a>
                    @endif
                    <a class="dropdown-item" href="{{ route('client.logout') }}" style="color: #333;">
                        <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                        Đăng xuất
                    </a>
                </div>
                </span>
                <a href="{{ route('client.logout') }}" class="text-white">
                    <i class="fa fa-sign-out mr-2"></i> Đăng xuất
                </a>
            </div>
            @else
            <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
                <i class="fa fa-sign-in mr-2"></i> Đăng nhập
            </a>
            @endif
        </div>
        <div class="languages float-left">
            {{-- <span class="pr-2"><a href=""><img src="assets/client/images/CoVN.jpg" alt=""></a></span>
            <span><a href=""><img src="assets/client/images/CoAnh.jpg" alt=""></a></span> --}}
            <span class="text-white" style="padding-right: 5px;"><i class="icon icon-phone mr-2"></i>02253.735682</span>
            {{-- <span class="text-white" style="padding-left: 7px;padding-right: 7px;border-left: 2px solid;border-right: 2px solid;"><i class="icon icon-envelope mr-2"></i>ngoaingu@vimaru.edu.vn</span> --}}
            <span class="text-white"
                style="padding-left: 7px;padding-right: 7px;border-left: 2px solid;border-right: 2px solid;"><a
                    href="lich-tuan" style="color: #fff;">Lịch tuần</a></span>
            <div class="dropdown" style="display: inline-block;">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"
                    style="border-radius: 0% !important;color: white;position: relative;bottom: 1px;padding: 1px 9px 1px 5px;">
                    Liên kết
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                    style="background: #18254A;margin-top: 0px;">
                    <a class="dropdown-item" href="http://vimaru.edu.vn/">Trường đại học Hàng hải Việt Nam</a>
                    <a class="dropdown-item" href="http://daotao.vimaru.edu.vn/">Phòng Đào tạo</a>
                    <a class="dropdown-item" href="http://ctsv.vimaru.edu.vn/">Phòng Công tác sinh viên</a>
                    <a class="dropdown-item" href="http://khaothi.vimaru.edu.vn/">Phòng Khảo thí &amp; Đảm bảo chất
                        lượng</a>
                    <a class="dropdown-item" href="http://doanthanhnien.vimaru.edu.vn/">Đoàn TNCS Hồ Chí Minh</a>
                    <a class="dropdown-item" href="http://http//gdtc.vimaru.edu.vn">Trung tâm Giáo dục thể chất</a>
                    <a class="dropdown-item" href="http://tailieuso.vimaru.edu.vn/">Thư viện</a>
                    <a class="dropdown-item" href="http://dktt.vimaru.edu.vn/">Đăng ký tín chỉ</a>
                </div>
            </div>
            <!-- <span class="ml-3"><a href="{{ route('lienhe.create') }}" class="text-white"><i
                        class="icon icon-envelope mr-2"></i>Liên hệ</a></span> -->
        </div>
    </div>
</div>
<div class="bg-top navbar-light">
    <div class="container">
        <div class="row no-gutters d-flex align-items-center" style="width: 100%;">
            <div class="col-lg-12 logosmall"></div>
            <div class="col-lg-12 d-block">
                <div>
                    <div class="col-md d-flex topper align-items-center py-md-3 text-center" style="width: 100%;">
                        <div class="mr-1 logoleft"><a href=""><img src="assets/client/images/logo.png"
                                    style="width: 109%;" alt=""></a>
                        </div>
                        <div class="text" style="margin-right: 48px;">
                            <span class="pb-3 khoa">KHOA NGOẠI NGỮ</span>
                            <span style="font-weight: 600;">TRƯỜNG ĐẠI HỌC HÀNG HẢI VIỆT NAM</span>
                        </div>
                        <div class="mr-1"><a href="http://vimaru.edu.vn"><img src="http://vimaru.edu.vn/sites/default/files/logots_1.png" style="width: 89%;" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>