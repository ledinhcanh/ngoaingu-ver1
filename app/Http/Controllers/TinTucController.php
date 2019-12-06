<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\BoMon;
use App\Models\ChuyenMuc;
use App\Models\ChuyenNganh;
use App\Models\GiangVien;
use App\Models\GiangVien_MonHoc;
use App\Models\HocKi;
use App\Models\HocPhan;
use App\Models\Lich;
use App\Models\LichTuan;
use App\Models\MonHoc;
use App\Models\Muc;
use App\Models\SinhVien;
use App\Models\ThaoLuan;
use App\Models\TinhTrangHonNhan;
use App\Models\TinTheoDong;
use App\Models\Trang;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Session;
use Response;
use Storage;
use Symfony\Component\HttpFoundation\Request;

class TinTucController extends Controller
{
    public function __construct()
    {
        $events = Lich::all();
        $event = [];
        foreach ($events as $row) {
            $enddate = $row->end_date . "24:00:00";
            $event[] = \Calendar::event(
                $row->title,
                true,
                new \DateTime($row->start_date),
                new \DateTime($row->end_date),
                $row->id,
                [
                    'color' => $row->color,
                ]
            );
        }
        $calendar = \Calendar::addEvents($event);
        $muc = Muc::where('status', 1)->get();
        $chuyenmuc = ChuyenMuc::where('status', 1)->get();
        // $baiviet = BaiViet::where(['status' => 1, 'idchuyenmuc' => [46, 48, 49, 50, 51, 52, 53]])->orderBy('id', 'desc')->paginate(5);
        $baiviet = BaiViet::where('status', 1)->whereIn('idchuyenmuc', [46, 48, 49, 50, 51, 52, 53])->orderBy('id', 'desc')->take(5)->get();
        $baiviet1 = BaiViet::where('status', 1)->whereIn('idchuyenmuc', [46, 48, 49, 50, 51, 52, 53])->orderBy('id', 'desc')->take(3)->get();
        $thongbao = BaiViet::Select('id', 'slug', 'title', 'content', 'updated_at', 'image')->where(['status' => 1, 'idchuyenmuc' => 45])->take(3)->get();
        view()->share(['muc' => $muc, 'chuyenmuc' => $chuyenmuc, 'baiviet' => $baiviet, 'baiviet1' => $baiviet1, 'thongbao' => $thongbao, 'events' => $events, 'calendar' => $calendar]);
    }
    public function bomon($slug)
    {
        $chuyenmuc1 = ChuyenMuc::where('slug', $slug)->first();
        $gtbm = BaiViet::where(['status' => 1, 'idchuyenmuc' => $chuyenmuc1->id])->first();
        $bomon = ChuyenMuc::where(['status' => 1, 'idmuc' => 1])->whereNotIn('slug', ['gioi-thieu', $slug])->get();
        return view('client.pages.gtbomon', compact('gtbm', 'bomon', 'chuyenmuc1'));
    }
    public function tuyensinh($slug)
    {
        $chuyenmuc2 = ChuyenMuc::where('slug', $slug)->first();
        $tintuc = BaiViet::Select('id', 'title', 'content', 'updated_at', 'image')->where(['status' => 1, 'idchuyenmuc' => $chuyenmuc2->id])->first();
        // dd($tintuc->content);
        return view('client.pages.tuyensinh', compact('tintuc', 'chuyenmuc2'));
    }
    public function tintuc($slug)
    {
        $chuyenmuc1 = ChuyenMuc::where('slug', $slug)->first();
        if ($chuyenmuc1 != null) {
            $tintuc = BaiViet::Select('id', 'slug', 'title', 'description', 'updated_at', 'image')->orderBy('highlight', 'DESC')->where(['status' => 1, 'idchuyenmuc' => $chuyenmuc1->id])->orderBy('highlight', 'DESC')->orderBy('created_at', 'DESC')->paginate(5);
            return view('client.pages.tintuc', compact('tintuc', 'chuyenmuc1'));
        } else {
            $baivietKey = 'baiviet_' . $slug;
            if (!Session::has($baivietKey)) {
                BaiViet::where('slug', $slug)->increment('view');
                Session::put($baivietKey, 1);
            }
            $idcm = BaiViet::Select('idchuyenmuc')->where('slug', $slug)->first();
            $chuyenmuc2 = ChuyenMuc::where('id', $idcm->idchuyenmuc)->get();
            $tintuc = BaiViet::where(['status' => 1, 'slug' => $slug])->first();
            $tintuc11 = BaiViet::where(['status' => 1, 'idchuyenmuc' => $idcm->idchuyenmuc])->get();
            $tintuc1 = $tintuc11->whereNotIn('id', $tintuc->id)->take(3);
            $test = $tintuc->TinTheoDong;
            if (isset($test[0]->id)) {
                $tintd = TinTheoDong::find($test[0]->id);
                $tintheodong = $tintd->BaiViet;
                return view('client.pages.detail', compact('tintuc', 'chuyenmuc2', 'tintuc1', 'tintheodong'));
            } else {
                return view('client.pages.detail', compact('tintuc', 'chuyenmuc2', 'tintuc1'));
            }

        }
    }
    public function chuyennganh($slug)
    {
        if ($slug == 'tieng-anh-thuong-mai') {
            $chuyenmuc1 = ChuyenMuc::where('slug', $slug)->first();
            $chuyennganh = BaiViet::where(['status' => 1, 'idchuyenmuc' => $chuyenmuc1->id])->first();
            $hocphan = HocPhan::where(['idchuyennganh' => 1, 'idhocki' => 1])->get();
            $hocki = HocKi::all();
            return view('client.pages.chuyennganh', compact('chuyennganh', 'chuyenmuc1', 'hocphan', 'hocki'));
        } else {
            $chuyenmuc1 = ChuyenMuc::where('slug', $slug)->first();
            $chuyennganh = BaiViet::where(['status' => 1, 'idchuyenmuc' => $chuyenmuc1->id])->first();
            $hocphan = HocPhan::where(['idchuyennganh' => 2, 'idhocki' => 1])->get();
            $hocki = HocKi::all();
            return view('client.pages.chuyennganh', compact('chuyennganh', 'chuyenmuc1', 'hocphan', 'hocki'));
        }

    }
    public function tuyendung()
    {
        $chuyenmuc1 = Muc::where('slug', 'viec-lam')->first();
        $trang = Trang::where('status', 1)->paginate(5);
        return view('client.pages.trang', compact('trang', 'chuyenmuc1'));
    }
    public function cttuyendung($slug)
    {
        $chuyenmuc1 = Muc::where('slug', 'viec-lam')->first();
        $trang = Trang::where(['status' => 1, 'slug' => $slug])->first();
        return view('client.pages.cttrang', compact('trang', 'chuyenmuc1'));
    }

    public function profile($id)
    {
        $giangvien = GiangVien::where('magv', $id)->first();
        $sinhvien = SinhVien::where('masv', $id)->first();
        if ($giangvien) {
            $thaoluan = ThaoLuan::where('idtaikhoan', $giangvien->TaiKhoan->id)->orderBy('created_at', 'desc')->paginate(3);
        } else {
            $thaoluan = ThaoLuan::where('idtaikhoan', $sinhvien->TaiKhoan->id)->orderBy('created_at', 'desc')->paginate(3);
            // dd($sinhvien->id);
        }
        return view('client.pages.profile', compact('sinhvien', 'giangvien', 'thaoluan'));
    }
    public function profile1($id)
    {
        // $taikhoan = User::where('id')
        $taikhoan = User::where('id', $id)->first();
        if ($taikhoan->idquyenhan == 3) {
            $giangvien = GiangVien::where('idtaikhoan', $taikhoan->id)->first();
            $thaoluan = ThaoLuan::where('idtaikhoan', $giangvien->TaiKhoan->id)->orderBy('created_at', 'desc')->paginate(3);
            return view('client.pages.profile', compact('giangvien', 'thaoluan'));
        } else {
            $sinhvien = SinhVien::where('idtaikhoan', $taikhoan->id)->first();
            $thaoluan = ThaoLuan::where('idtaikhoan', $sinhvien->TaiKhoan->id)->orderBy('created_at', 'desc')->paginate(3);
            return view('client.pages.profile', compact('sinhvien', 'thaoluan'));
        }

    }
    public function editprofile($id)
    {
        if (Auth::user()->QuyenHan->id == 3) {
            $giangvien = GiangVien::where('id', $id)->first();
            $bomon = BoMon::all();
            $tthn = TinhTrangHonNhan::all();
            $monhoc = MonHoc::all();
            $getAll = GiangVien_MonHoc::where('giang_vien_id', $id)->pluck('mon_hoc_id');
            return view('client.pages.trangcanhan.edit', compact('giangvien', 'bomon', 'tthn', 'monhoc', 'getAll'));
        } else {
            $sinhvien = SinhVien::where('id', $id)->first();
            $chuyennganh = ChuyenNganh::all();
            return view('client.pages.trangcanhan.edit', compact('sinhvien', 'chuyennganh'));
        }
    }

    public function timkiem(Request $request)
    {
        $keyword = $request->input('key');
        $total = BaiViet::where('description', 'LIKE', '%' . $keyword . '%')->whereIn('idchuyenmuc', [27, 28, 29, 30, 31, 32, 45, 46, 47, 48, 49, 50, 51, 52, 53])->take(30)->count(); // Đếm kết quả
        $tintuc = BaiViet::where('description', 'LIKE', '%' . $keyword . '%')->whereIn('idchuyenmuc', [27, 28, 29, 30, 31, 32, 45, 46, 47, 48, 49, 50, 51, 52, 53])->take(30)->paginate(5); // Tìm trong tên hoặc mô tả
        return view('client.pages.timkiem', compact('tintuc', 'keyword', 'total'));
    }
    public function lichtuan()
    {
        $lichtuan = LichTuan::orderBy('tuan', 'desc')->paginate(10);
        return view('client.pages.lichtuan.list', compact('lichtuan'));
    }
    public function ctlichtuan($slug)
    {
        $lichtuan = LichTuan::where('slug', $slug)->first();
        return view('client.pages.lichtuan.detail', compact('lichtuan'));
    }

    public function lichsh()
    {
        return view('client.pages.lich');
    }
   
}
