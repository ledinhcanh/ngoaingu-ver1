<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiangVienRequest;
use App\Models\GiangVien;
use App\Models\GiangVien_MonHoc;
use App\Models\MonHoc;
use App\Models\BoMon;
use App\Models\TinhTrangHonNhan;
use App\Models\User;
use Auth;
use File;
use Illuminate\Http\Request;

class GiangVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('view', GiangVien::class)) {
            $giangvien = GiangVien::all();
            return view('admin.pages.giangvien.list', compact('giangvien'));
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
        if ($user->can('view', GiangVien::class)) {
            $taikhoan = User::where('idquyenhan', '3')->get();
            $bomon = BoMon::all();
            $monhoc = MonHoc::all();
            $tthn = TinhTrangHonNhan::all();
            return view('admin.pages.giangvien.add', compact('taikhoan', 'monhoc','bomon','tthn'));
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
    public function store(GiangvienRequest $request)
    {
        $user = Auth::user();
        if ($user->can('view', GiangVien::class)) {
            if ($request->hasFile('avatar')) {
                $file = $request->avatar;
                $file_name = $file->getClientOriginalName();
                $file_type = $file->getMimeType();
                $file_size = $file->getSize();
                if ($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif') {
                    if ($file_size <= 1048576) {
                        $file_name = date('D-m-yyyy') . '-' . rand() . '-' . utf8tourl($file_name);
                        if ($file->move('img/upload/avatar', $file_name)) {
                            $data = $request->all();
                            $data['avatar'] = $file_name;
                            $monhoc = $request->monhoc;
                            $gvcreate = GiangVien::create($data);
                            $gvcreate->MonHoc()->attach($request->monhoc);
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
                $monhoc = $request->monhoc;
                $gvmh = GiangVien::create($data);
                $gvmh->MonHoc()->attach($request->monhoc);
                return redirect()->back()->with('thongbao', 'Đã thêm thành công');
            }

        } else {
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function show(GiangVien $giangVien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->can('view', GiangVien::class)) {
            $giangvien = GiangVien::findOrFail($id);
            $taikhoan = User::where('idquyenhan', '3')->get();
            $bomon = BoMon::all();
            $tthn = TinhTrangHonNhan::all();
            $monhoc = MonHoc::all();
            $getAll = GiangVien_MonHoc::where('giang_vien_id', $id)->pluck('mon_hoc_id');
            return view('admin.pages.giangvien.edit', compact('giangvien', 'taikhoan', 'getAll', 'bomon', 'monhoc','tthn'));
        } else {
            return view('errors.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function update(GiangVienRequest $request, $id)
    {
        // $user = Auth::user();
        // if ($user->can('view', GiangVien::class)) {
            $giangvien = GiangVien::find($id);
            $data = $request->all();
            if ($request->hasFile('avatar')) {
                $file = $request->avatar;
                $file_name = $file->getClientOriginalName();
                $file_type = $file->getMimeType();
                $file_size = $file->getSize();
                if ($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif') {
                    if ($file_size <= 1048576) {
                        $file_name = date('D-m-yyyy') . '-' . rand() . '-' . utf8tourl($file_name);
                        if ($file->move('img/upload/avatar', $file_name)) {
                            $data['avatar'] = $file_name;
                            if ($giangvien->avatar != 'no-avatar.jpg') {
                                if (File::exists('img/upload/avatar/' . $giangvien->avatar)) {
                                    unlink('img/upload/avatar/' . $giangvien->avatar);
                                }}
                        }
                    } else {
                        return back()->with('error', 'Ảnh của bạn quá lớn chỉ được upload ảnh dưới 1mb');
                    }
                } else {
                    return back()->with('error', 'File bạn chọn không là hình ảnh');
                }
            } else {
                $data['avatar'] = $giangvien->avatar;
            }
            $giangvien->update($data);
            $giangvien->MonHoc()->sync($request->monhoc);
            if(Auth::user()->QuyenHan->id == 3){
                return redirect()->back()->with('thongbaott', 'Cập nhật thông tin thành công');
            }else{
                return redirect()->route('giangvien.index')->with('thongbao', 'Đã sửa thành công');
            }
        // } else {
        //     return view('errors.403');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->can('view', GiangVien::class)) {
            $giangvien = GiangVien::find($id);
            if ($giangvien) {
                if ($giangvien->avatar != 'no-avatar.jpg') {
                    if (File::exists('img/upload/avatar/' . $giangvien->avatar)) {
                        unlink('img/upload/avatar/' . $giangvien->avatar);
                    }}
                $giangvien->MonHoc()->detach();
                $giangvien->delete();
                return back()->with('thongbao', 'Đã xóa thành công');
            }
        } else {
            return view('errors.403');
        }
    }
}
