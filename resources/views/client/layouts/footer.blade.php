<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 col-lg-4">
                <div class="ftco-footer-widget mb-5">
                    <h2 class="ftco-heading-2">Liên hệ</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text"
                                    style="text-align: justify;color: #fff;">Phòng 211, nhà A5, Trường Đại học Hàng hải Việt
                                    Nam, số 484 Lạch Tray, Lê Chân, Hải Phòng</span></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text">02253 735
                                        682</span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span
                                        class="text">ngoaingu@vimaru.edu.vn</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="ftco-footer-widget mb-5 ml-md-3">
                    <h2 class="ftco-heading-2">Liên kết</h2>
                    <ul class="list-unstyled">
                        <li><a href="http://vimaru.edu.vn/"><span class="ion-ios-arrow-round-forward mr-2"></span>Trường đại học Hàng
                                hải Việt Nam</a></li>
                        <li><a href="http://daotao.vimaru.edu.vn/"><span class="ion-ios-arrow-round-forward mr-2"></span>Phòng Đào tạo</a></li>
                        <li><a href="http://ctsv.vimaru.edu.vn/"><span class="ion-ios-arrow-round-forward mr-2"></span>Phòng Công tác sinh
                                viên</a></li>
                        <li><a href="http://khaothi.vimaru.edu.vn/"><span class="ion-ios-arrow-round-forward mr-2"></span>Phòng Khảo thí & Đảm
                                bảo chất lượng</a></li>
                        <li><a href="http://doanthanhnien.vimaru.edu.vn/"><span class="ion-ios-arrow-round-forward mr-2"></span>Đoàn TNCS Hồ Chí
                                Minh</a></li>
                        <li><a href="http://http//gdtc.vimaru.edu.vn"><span class="ion-ios-arrow-round-forward mr-2"></span>Trung tâm Giáo dục thể
                                chất</a></li>
                        <li><a href="http://tailieuso.vimaru.edu.vn/"><span class="ion-ios-arrow-round-forward mr-2"></span>Thư viện</a></li>
                        <li><a href="http://dktt.vimaru.edu.vn/"><span class="ion-ios-arrow-round-forward mr-2"></span>Đăng ký tín chỉ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 offset-lg-2">
                <div class="ftco-footer-widget mb-5">
                    <h2 class="ftco-heading-2">Fanpage Facebook</h2>
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FKhoa-Ngo%E1%BA%A1i-ng%E1%BB%AF-%C4%90H-H%C3%A0ng-h%E1%BA%A3i-Vi%E1%BB%87t-Nam-English-VMU-1509989675902950&tabs=timeline&width=262&height=208&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=2240008486097792" width="262" height="208" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p style="color: #fff;">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                    document.write(new Date().getFullYear());
                    </script> | Khoa Ngoại ngữ - Trường Đại học Hàng hải Việt Nam
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- log in -->
<div class="modal fade ftco-animate" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Đăng nhập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Username</label>
                        <input type="text" class="form-control" placeholder="" name="name" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input type="password" class="form-control" placeholder="" name="password" required="">
                    </div>
                    <div class="sub-w3l">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                            <label class="custom-control-label" for="customControlAutosizing">Nhớ mật khẩu ?</label>
                        </div>
                    </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" value="Đăng nhập">
                    </div>

                    <p class="text-center dont-do mt-3 khoiphuctaikhoan">
                        <a href="{{ url('/password/reset') }}" style="color: gray;">Khôi phục
                            tài khoản của bạn</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
            stroke="#F96D00" /></svg></div>
<!-- <button class="scrollup" id="myBtn" style="display: none;"><i class="fa fa-chevron-up"></i></button> -->