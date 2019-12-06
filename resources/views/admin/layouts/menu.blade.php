<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"
  style="margin-bottom: -23px !important;">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin/" style="height: 3.375rem;">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">VMU</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  @if(Auth::user()->idquyenhan == 1 || Auth::user()->idquyenhan == 2)
  <li class="nav-item {{ \Request::route()->getName() == 'admin'?'active':'' }}">
    <a class="nav-link" href="admin/">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Tổng quan</span></a>
  </li>
  @endif
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Quản lý
  </div>
  @if(Auth::user()->idquyenhan == 1 || Auth::user()->idquyenhan == 2)
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item {{ \Request::route()->getName() == 'muc.index'?'active':'' }}{{ \Request::route()->getName() == 'muc.create'?'active':'' }}
                {{ \Request::route()->getName() == 'muc.edit'?'active':'' }}">
    <a href="{{ route('muc.index') }}" class="nav-link collapsed" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fa fa-folder"></i>
      <span style="padding-left: 3px;">Mục</span>
    </a>
  </li>
  <li class="nav-item {{ \Request::route()->getName() == 'chuyenmuc.index'?'active':'' }}{{ \Request::route()->getName() == 'chuyenmuc.create'?'active':'' }}
                    {{ \Request::route()->getName() == 'chuyenmuc.edit'?'active':'' }}">
    <a href="{{ route('chuyenmuc.index') }}" class="nav-link collapsed" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fa fa-folder-open"></i>
      <span style="padding-left: 3px;">Chuyên mục</span>
    </a>
  </li>
  <li class="nav-item {{ \Request::route()->getName() == 'baiviet.index'?'active':'' }}{{ \Request::route()->getName() == 'baiviet.create'?'active':'' }}
                    {{ \Request::route()->getName() == 'baiviet.edit'?'active':'' }}">
    <a href="{{ route('baiviet.index') }}" class="nav-link collapsed" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fa fa-list-alt"></i>
      <span style="padding-left: 3px;">Bài viết</span>
    </a>
  </li>
  <li class="nav-item {{ \Request::route()->getName() == 'slide.index'?'active':'' }}{{ \Request::route()->getName() == 'slide.create'?'active':'' }}
                    {{ \Request::route()->getName() == 'slide.edit'?'active':'' }}">
    <a href="{{ route('slide.index') }}" class="nav-link collapsed" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-sliders-h"></i>
      <span style="padding-left: 3px;">Slide</span>
    </a>
  </li>
  @endif
  @if(Auth::user()->idquyenhan == 1)
  <li class="nav-item {{ \Request::route()->getName() == 'taikhoan.index'?'active':'' }}{{ \Request::route()->getName() == 'taikhoan.create'?'active':'' }}
                    {{ \Request::route()->getName() == 'taikhoan.edit'?'active':'' }}">
    <a href="{{ route('taikhoan.index') }}" class="nav-link collapsed" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fa fa-key"></i>
      <span style="padding-left: 3px;">Tài khoản</span>
    </a>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li
    class="nav-item {{ \Request::route()->getName() == 'giangvien.index'?'active':'' }}{{ \Request::route()->getName() == 'sinhvien.index'?'active':'' }}
                {{ \Request::route()->getName() == 'sinhvien.create'?'active':'' }}{{ \Request::route()->getName() == 'giangvien.create'?'active':'' }}
                {{ \Request::route()->getName() == 'sinhvien.edit'?'active':'' }}{{ \Request::route()->getName() == 'giangvien.edit'?'active':'' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true"
      aria-controls="collapseUtilities">
      <i class="fas fa-users"></i>
      <span>Người dùng</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('sinhvien.index') }}">Sinh viên</a>
        <a class="collapse-item" href="{{ route('giangvien.index') }}">Giảng viên</a>
      </div>
    </div>
  </li>
  <li
    class="nav-item {{ \Request::route()->getName() == 'lienhe.index'?'active':'' }}">
    <a href="{{ route('lienhe.index') }}">
      <a href="{{ route('lienhe.index') }}" class="nav-link collapsed" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fa fa-envelope"></i>
        <span style="padding-left: 6px;">Liên hệ</span>
      </a>
  </li>
  @endif
  @if(Auth::user()->idquyenhan == 1 || Auth::user()->idquyenhan == 2)
  <li class="nav-item {{ \Request::route()->getName() == 'trang.index'?'active':'' }}{{ \Request::route()->getName() == 'trang.create'?'active':'' }}
      {{ \Request::route()->getName() == 'trang.edit'?'active':'' }}">
    <a href="{{ route('trang.index') }}" class="nav-link collapsed" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fa fa-clone"></i>
      <span style="padding-left: 3px;">Trang</span>
    </a>
  </li>
  <li class="nav-item {{ \Request::route()->getName() == 'baithaoluan.index'?'active':'' }}">
    <a href="{{ route('baithaoluan.index') }}" class="nav-link collapsed" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fa fa-newspaper"></i>
      <span style="padding-left: 6px;">Bài thảo luận</span>
    </a>
  </li>
  <li class="nav-item {{ \Request::route()->getName() == 'lich.index'?'active':'' }}">
    <a href="{{ route('lich.index') }}" class="nav-link collapsed" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fa fa-calendar"></i>
      <span style="padding-left: 6px;">Sự kiện</span>
    </a>
  </li>
  <li class="nav-item {{ \Request::route()->getName() == 'lichtuan.index'?'active':'' }}">
    <a href="{{ route('lichtuan.index') }}" class="nav-link collapsed" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fa fa-calendar"></i>
      <span style="padding-left: 6px;">Lịch tuần</span>
    </a>
  </li>
  <li class="nav-item {{ \Request::route()->getName() == 'ctdaotao.index'?'active':'' }}">
    <a href="{{ route('ctdaotao.index') }}" class="nav-link collapsed" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fa fa-newspaper"></i>
      <span style="padding-left: 6px;">Chương trình đào tạo</span>
    </a>
  </li>
  @endif
  <li
    class="nav-item {{ \Request::route()->getName() == 'tailieu.index'?'active':'' }}{{ \Request::route()->getName() == 'tailieu.create'?'active':'' }}">
    <a href="{{ route('tailieu.index') }}">
      <a href="{{ route('tailieu.index') }}" class="nav-link collapsed" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-file-pdf"></i>
        <span style="padding-left: 6px;">Tài liệu</span>
      </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  {{-- <div class="sidebar-heading">
        Addons
      </div> --}}

  <!-- Nav Item - Pages Collapse Menu -->

  <!-- Nav Item - Charts -->
  {{-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item active">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li> --}}

  {{-- <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block"> --}}

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>