<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaiKhoanRequest;
use App\Models\BaiViet;
use App\Models\ChuyenMuc;
use App\Models\BinhLuan;
use App\Models\ThaoLuan;
use App\Models\Muc;
use App\Models\Lich;
use App\Models\QuyenHan;
use App\Models\TaiLieu;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $events = Lich::all();
        $event = [];
        foreach ($events as $row) {
            $enddate = $row->end_date."24:00:00";
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
        $baiviet = BaiViet::where('status', 1)->whereIn('idchuyenmuc', [46, 48, 49, 50, 51, 52, 53])->orderBy('id', 'desc')->paginate(5);
        $baiviet1 = BaiViet::where('status', 1)->whereIn('idchuyenmuc', [46, 48, 49, 50, 51, 52, 53])->orderBy('id', 'desc')->paginate(3);
        $thongbao = BaiViet::Select('id', 'slug', 'title', 'content', 'updated_at', 'image')->where(['status' => 1, 'idchuyenmuc' => 45])->paginate(3);
        view()->share(['muc' => $muc, 'chuyenmuc' => $chuyenmuc, 'baiviet' => $baiviet, 'baiviet1' => $baiviet1, 'thongbao' => $thongbao, 'events' => $events, 'calendar' => $calendar]);
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->can('view', User::class)) {
            $taikhoan = User::select('id', 'name', 'email', 'idquyenhan')->get();
            return view('admin.pages.taikhoan.list', compact("taikhoan"));
        } else {
            return view('errors.403');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->can('view', User::class)) {
            $quyenhan = QuyenHan::all();
            return view('admin.pages.taikhoan.add', compact("quyenhan"));
        } else {
            return view('errors.403');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaiKhoanRequest $request)
    {
        $user = Auth::user();
        if ($user->can('view', User::class)) {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            User::create($data);
            return redirect()->back()->with('thongbao', 'Đã thêm thành công');
        } else {
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function show(TaiKhoan $taiKhoan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->can('view', User::class)) {
            $taikhoan = User::findOrFail($id);
            $quyenhan = QuyenHan::all();
            return view('admin.pages.taikhoan.edit', compact('taikhoan', 'quyenhan'));
        } else {
            return view('errors.403');
        }
    }

    public function editdetail($id)
    {
        $taikhoan = User::findOrFail($id);
        $quyenhan = QuyenHan::all();
        return view('admin.pages.taikhoan.detail', compact('taikhoan', 'quyenhan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $this->validate($request,
            [
                'name' => 'required|min:3|max:50',
            ],
            [
                'name.required' => 'Bạn chưa nhập Tên tài khoản!',
                'name.min' => 'Tên tài khoản gồm tối thiểu 3 ký tự!',
                'name.max' => 'Tên tài khoản không được vượt quá 50 ký tự!',
            ]);
        $taikhoan = User::find($id);
        $data = $request->all();
        if ($request->changePassword == "on") {
            $this->validate($request,
                [
                    'password' => 'required|min:6|max:32',
                    'passwordAgain' => 'required|same:password',
                ],
                [
                    'password.required' => 'Bạn chưa nhập mật khẩu!',
                    'password.min' => 'Mật khẩu gồm tối thiểu 6 ký tự!',
                    'password.max' => 'Mật khẩu không được vượt quá 32 ký tự!',
                    'passwordAgain.required' => 'Bạn chưa xác nhận mật khẩu!',
                    'passwordAgain.same' => 'Mật khẩu xác nhận chưa khớp với mật khẩu đã nhập!',
                ]);
            $data['password'] = Hash::make($request->password);
        }
        $taikhoan->update($data);
        if ($user->can('view', User::class)) {
            return redirect()->route('taikhoan.index')->with('thongbao', 'Đã sửa thành công');
        } else {
            return redirect()->route('admin')->with('thongbao', 'Đã sửa thành công');
        }
    }

    public function updatedetail(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required|min:3|max:50',
            ],
            [
                'name.required' => 'Bạn chưa nhập Tên tài khoản!',
                'name.min' => 'Tên tài khoản gồm tối thiểu 3 ký tự!',
                'name.max' => 'Tên tài khoản không được vượt quá 50 ký tự!',
            ]);
        $taikhoan = User::find($id);
        $data = $request->all();
        if ($request->changePassword == "on") {
            $this->validate($request,
                [
                    'password' => 'required|min:6|max:32',
                    'passwordAgain' => 'required|same:password',
                ],
                [
                    'password.required' => 'Bạn chưa nhập mật khẩu!',
                    'password.min' => 'Mật khẩu gồm tối thiểu 6 ký tự!',
                    'password.max' => 'Mật khẩu không được vượt quá 32 ký tự!',
                    'passwordAgain.required' => 'Bạn chưa xác nhận mật khẩu!',
                    'passwordAgain.same' => 'Mật khẩu xác nhận chưa khớp với mật khẩu đã nhập!',
                ]);
            $data['password'] = Hash::make($request->password);
        }
        $taikhoan->update($data);
        return redirect()->route('admin')->with('thongbao', 'Đã sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaiKhoan  $taiKhoan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->can('view', User::class)) {
            $taikhoan = User::find($id);
            if (!$taikhoan->GiangVien && !$taikhoan->SinhVien) {
                $taikhoan->delete();
                return back()->with('thongbao', 'Đã xóa thành công');} else {
                return back()->with('error', 'Không thể xóa khi còn liên kết');
            }
        } else {
            return view('errors.403');
        }
    }
    public function loginAdmin(Request $request)
    {
        $data = $request->only('name', 'password');
        if (Auth::attempt($data)) {
            if (Auth::user()->idquyenhan > 0 && Auth::user()->idquyenhan < 3) {
                return redirect('admin/');
            } else if(Auth::user()->idquyenhan == 4) {
                return redirect()->back()->with('error', 'Bạn không có quyền vào trang này');
            }else if(Auth::user()->idquyenhan == 3){
                return redirect('admin/tailieu');
            }

        } else {
            return redirect()->route('login.admin')->with('error', 'Đăng nhập thất bại. Xin vui lòng kiểm tra lại tài khoản');
        }
    }
    public function logoutAdmin()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('admin/login');
        } else {
            return redirect('admin/login');
        }
    }
    public function logoutclient()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/');
        }
    }
    public function loginclient(Request $request)
    {
        $data = $request->only('name', 'password');
        if (Auth::attempt($data)) {
            return redirect('/');
        } else {
            return redirect('/')->with('error', 'Đăng nhập thất bại. Xin vui lòng kiểm tra lại tài khoản');
        }
    }
    public function doimatkhau($id)
    {
        return view('client.pages.trangcanhan.doimatkhau');
    }
    public function updatematkhau(Request $request, $id)
    {
        $taikhoan = User::find($id);
        $this->validate($request,
            [
                'password' => 'required|min:6|max:32',
                'passwordAgain' => 'required|same:password',
            ],
            [
                'password.required' => 'Bạn chưa nhập mật khẩu!',
                'password.min' => 'Mật khẩu gồm tối thiểu 6 ký tự!',
                'password.max' => 'Mật khẩu không được vượt quá 32 ký tự!',
                'passwordAgain.required' => 'Bạn chưa xác nhận mật khẩu!',
                'passwordAgain.same' => 'Mật khẩu xác nhận chưa khớp với mật khẩu đã nhập!',
            ]);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        if (Hash::check($request->passwordold, $taikhoan->password)) {
            $taikhoan->update($data);
            return back()->with('thongbaotc', 'Đổi mật khẩu thành công');
        } else {
            return back()->with('thongbaomk', 'Mật khẩu hiện tại không đúng vui lòng kiểm tra lại');
        }
    }
    public function indexadmin()
    {
        if (Auth::user()->QuyenHan->id != 4) {
            $baiviet = BaiViet::all();
            $baithaoluan = ThaoLuan::all();
            $binhluan = BinhLuan::all();
            $tailieu = TaiLieu::all();
            $thaoluan = ThaoLuan::where('status', 0)->orderBy('id', 'desc')->paginate(5);
            return view('admin.pages.index', compact('thaoluan', 'baiviet', 'baithaoluan', 'binhluan', 'tailieu'));
        } else {
            return view('admin.pages.login');
        }
    }

}
