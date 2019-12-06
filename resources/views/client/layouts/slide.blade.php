<div class="container">
<section class="home-slider owl-carousel">
    @foreach ($slide as $sl)
        <div class="slider-item" style="background-image:url(img/upload/slide/{{ $sl->image }});">
            <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-start"
                        data-scrollax-parent="true">
                        <div class="col-md-7 ftco-animate">
                            <!-- <span class="subheading">Welcome</span>
                                <h1 class="mb-4">KHOA NGOẠI NGỮ</h1> -->
                            <!-- <p><a href="#" class="btn btn-primary px-4 py-3 mt-3">Our Services</a></p> -->
                        </div>
                    </div>
                </div>
        </div>
    @endforeach
</section>
</div>