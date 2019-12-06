<?php

namespace App\Http\Controllers;

use App\Http\Requests\SinhVienRequest;
use App\Models\ChuyenNganh;
use App\Models\SinhVien;
use App\Models\User;
use Auth;
use File;
use Illuminate\Http\Request;

class SinhVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('view', SinhVien::class)) {
            $sinhvien = SinhVien::select('id', 'masv', 'fullname', 'birthday', 'avatar', 'sex', 'idlop')->get();
            return view('admin.pages.sinhvien.list', compact('sinhvien'));
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
        if ($user->can('view', SinhVien::class)) {
            $taikhoan = User::where('idquyenhan', '4')->get();
            $chuyennganh = ChuyenNganh::all();
            return view('admin.pages.sinhvien.add', compact('taikhoan', 'chuyennganh'));
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
    public function store(SinhVienRequest $request)
    {
        $user = Auth::user();
        if ($user->can('view', SinhVien::class)) {
            if ($request->hasFile('avatar')) {
                $file = $request->avatar;
                //Lấy tên file
                $file_name = $file->getClientOriginalName();
                //Lấy loại file
                $file_type = $file->getMimeType();
                //Kích thước file với đơn vị byte
                $file_size = $file->getSize();
                if ($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif') {
                    if ($file_size <= 1048576) {
                        $file_name = date('D-m-yyyy') . '-' . rand() . '-' . utf8tourl($file_name);
                        if ($file->move('img/upload/avatar', $file_name)) {
                            $data = $request->all();
                            $data['avatar'] = $file_name;
                            SinhVien::create($data);
                            return redirect()->back()->with('thongbao', 'Đã thêm thành công');
                        }
                    } else {
                        return back()->with('error', 'Bạn không thể upload ảnh quá 1mb');
                    }
                } else {
                    return back()->with('error', 'File bạn chọn không là hình ảnh');
                }
            } else {
                $data = $request->all();
                SinhVien::create($data);
                return redirect()->back()->with('thongbao', 'Đã thêm thành công');
            }
        } else {
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SinhVien  $sinhVien
     * @return \Illuminate\Http\Response
     */
    public function show(SinhVien $sinhVien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SinhVien  $sinhVien
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->can('view', SinhVien::class)) {
            $sinhvien = SinhVien::findOrFail($id);
            $taikhoan = User::where('idquyenhan', '4')->get();
            $chuyennganh = ChuyenNganh::all();
            return view('admin.pages.sinhvien.edit', compact('sinhvien', 'taikhoan', 'chuyennganh'));
        } else {
            return view('errors.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SinhVien  $sinhVien
     * @return \Illuminate\Http\Response
     */
    public function update(SinhVienRequest $request, $id)
    {
        // $user = Auth::user();
        // if ($user->can('view', SinhVien::class)) {
            $sinhvien = SinhVien::find($id);
            $data = $request->all();
            if ($request->hasFile('avatar')) {
                $file = $request->avatar;
                //Lấy tên file
                $file_name = $file->getClientOriginalName();
                //Lấy loại file
                $file_type = $file->getMimeType();
                //Kích thước file với đơn vị byte
                $file_size = $file->getSize();
                if ($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif') {
                    if ($file_size <= 1048576) {
                        $file_name = date('D-m-yyyy') . '-' . rand() . '-' . utf8tourl($file_name);
                        if ($file->move('img/upload/avatar', $file_name)) {
                            $data['avatar'] = $file_name;
                            if ($sinhvien->avatar != 'no-avatar.jpg') {
                                if (File::exists('img/upload/avatar/' . $sinhvien->avatar)) {
                                    //Xóa file
                                    unlink('img/upload/avatar/' . $sinhvien->avatar);
                                }}
                        }
                    } else {
                        return back()->with('error', 'Ảnh của bạn quá lớn chỉ được upload ảnh dưới 1mb');
                    }
                } else {
                    return back()->with('error', 'File bạn chọn không là hình ảnh');
                }
            } else {
                $data['avatar'] = $sinhvien->avatar;
            }
            $sinhvien->update($data);
            if(Auth::user()->QuyenHan->id == 4){
                return redirect()->back()->with('thongbaott', 'Cập nhật thông tin thành công');
            }else{
                return redirect()->route('sinhvien.index')->with('thongbao', 'Đã sửa thành công'); 
            }
        // } else {
        //     return view('errors.403');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SinhVien  $sinhVien
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->can('view', SinhVien::class)) {
            $sinhvien = SinhVien::find($id);
            if ($sinhvien) {
                if ($sinhvien->avatar != 'no-avatar.jpg') {
                    if (File::exists('img/upload/avatar/' . $sinhvien->avatar)) {
                        unlink('img/upload/avatar/' . $sinhvien->avatar);
                    }
                }
                $sinhvien->delete();
                return back()->with('thongbao', 'Đã xóa thành công');
            }
        } else {
            return view('errors.403');
        }
    }
}
