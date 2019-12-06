<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container d-flex align-items-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <form action="tim-kiem" class="searchform order-lg-last">
            <div class="form-group d-flex">
                <input type="text" class="form-control pl-3" name="key" placeholder="Tìm kiếm" required>
                <button type="submit" placeholder="" class="form-control search"><span
                        class="ion-ios-search"></span></button>
            </div>
        </form>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"><a href="/" class="nav-link pl-0"><i class="fa fa-home"
                            aria-hidden="true" style="font-size: 22px;"></i></a></li>
                @foreach ($muc as $m)
                    @if (count($m->ChuyenMuc)>0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ $m->slug }}" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $m->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($m->ChuyenMuc as $cm)
                                @if ($cm->status == 1)
                                    @if ($m->slug == 'don-vi' || $m->slug == 'chuyen-nganh' || $m->slug == 'thao-luan' || $m->slug == 'tai-lieu' || $m->slug == 'tuyen-sinh')
                                        <a class="dropdown-item" href="{{ $m->slug }}/{{ $cm->slug }}">{{ $cm->name }}</a>
                                    @else
                                        <a class="dropdown-item" href="tin/{{ $cm->slug }}">{{ $cm->name }}</a>
                                    @endif
                                @endif
                                @endforeach
                            </div>
                        </li>
                    @else
                        <li class="nav-item"><a href="{{ $m->slug }}" class="nav-link"> {{ $m->name }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>