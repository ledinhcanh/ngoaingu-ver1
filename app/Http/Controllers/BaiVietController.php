<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaiVietRequest;
use App\Models\BaiViet;
use App\Models\BaiViet_TinTheoDong;
use App\Models\Muc;
use App\Models\TinTheoDong;
use Auth;
use File;
use Illuminate\Http\Request;

class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('view', BaiViet::class)) {
            $baiviet = BaiViet::select('id', 'title', 'content', 'description', 'highlight', 'image', 'view', 'status', 'idchuyenmuc')->get();
            return view('admin.pages.baiviet.list', compact('baiviet'));
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
        if ($user->can('view', BaiViet::class)) {
            $muc11 = Muc::where('status', 1)->get();
            $tintheodong = TinTheoDong::all();
            $muc = $muc11->whereNotIn('slug', 'tai-lieu');
            // dd($muc11);
            return view('admin.pages.baiviet.add', compact('muc','tintheodong'));
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
    public function store(BaiVietRequest $request)
    {
        $user = Auth::user();
        if ($user->can('view', BaiViet::class)) {
            if ($request->hasFile('image')) {
                $file = $request->image;
                //Lấy tên file
                $file_name = $file->getClientOriginalName();
                //Lấy loại file
                $file_type = $file->getMimeType();
                //Kích thước file với đơn vị byte
                $file_size = $file->getSize();
                if ($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif') {
                    if ($file_size <= 2097152) {
                        $file_name = date('D-m-yyyy') . '-' . rand() . '-' . utf8tourl($file_name);
                        if ($file->move('img/upload/baiviet', $file_name)) {
                            $data = $request->all();
                            $data['status'] = 1;
                            $data['slug'] = utf8tourl($request->title);
                            $data['image'] = $file_name;
                            $baiviet = BaiViet::create($data);
                            if($request->tintheodong != null){
                                $baiviet->TinTheoDong()->attach($request->tintheodong);
                            }
                            return redirect()->back()->with('thongbao', 'Đã thêm thành công');
                        }
                    } else {
                        return back()->with('error', 'Bạn không thể upload ảnh quá 2mb');
                    }
                } else {
                    return back()->with('error', 'File bạn chọn không là hình ảnh');
                }
            } else {
                return back()->with('error', 'Bạn chưa thêm ảnh minh họa cho sản phẩm');
            }
        } else {
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BaiViet  $baiViet
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BaiViet  $baiViet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->can('view', BaiViet::class)) {
            $baiviet = BaiViet::findOrFail($id);
            $muc11 = Muc::where('status', 1)->get();
            $tintheodong = TinTheoDong::all();
            $list = BaiViet_TinTheoDong::where('bai_viet_id', $id)->pluck('tin_theo_dong_id');
            $muc = $muc11->whereNotIn('slug', 'tai-lieu');
            return view('admin.pages.baiviet.edit', compact('baiviet', 'muc', 'list', 'tintheodong'));
        } else {
            return view('errors.403');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BaiViet  $baiViet
     * @return \Illuminate\Http\Response
     */
    public function update(BaiVietRequest $request, $id)
    {
        $user = Auth::user();
        if ($user->can('view', BaiViet::class)) {
            $baiviet = BaiViet::find($id);
            $data = $request->all();
            $data['slug'] = utf8tourl($request->title);
            if ($request->hasFile('image')) {
                $file = $request->image;
                //Lấy tên file
                $file_name = $file->getClientOriginalName();
                //Lấy loại file
                $file_type = $file->getMimeType();
                //Kích thước file với đơn vị byte
                $file_size = $file->getSize();
                if ($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif') {
                    if ($file_size <= 2097152) {
                        $file_name = date('D-m-yyyy') . '-' . rand() . '-' . utf8tourl($file_name);
                        if ($file->move('img/upload/baiviet', $file_name)) {
                            $data['image'] = $file_name;
                            if (File::exists('img/upload/baiviet/' . $baiviet->image)) {
                                //Xóa file
                                unlink('img/upload/baiviet/' . $baiviet->image);
                            }
                        }
                    } else {
                        return back()->with('error', 'Ảnh của bạn quá lớn chỉ được upload ảnh dưới 1mb');
                    }
                } else {
                    return back()->with('error', 'File bạn chọn không là hình ảnh');
                }
            } else {
                $data['image'] = $baiviet->image;
            }
            $baiviet->update($data);
            if($request->tintheodong != null){
                $baiviet->TinTheoDong()->sync($request->tintheodong);
            }
            return redirect()->route('baiviet.index')->with('thongbao', 'Đã sửa thành công');
        } else {
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BaiViet  $baiViet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->can('view', BaiViet::class)) {
            $baiviet = BaiViet::find($id);
            if ($baiviet) {
                if (File::exists('img/upload/baiviet/' . $baiviet->image)) {
                    unlink('img/upload/baiviet/' . $baiviet->image);
                }
                if($baiviet->tintheodong){
                    $baiviet->TinTheoDong()->detach();
                }
                $baiviet->delete();
                return back()->with('thongbao', 'Đã xóa thành công');
            }
        } else {
            return view('errors.403');
        }
    }
    public function action($action, $id)
    {
        if ($action == "status" || $action == "hl") {
            $baiviet = BaiViet::find($id);
            switch ($action) {
                case 'status':
                    $baiviet->status = $baiviet->status ? 0 : 1;
                    $baiviet->save();
                    break;
                case 'hl':
                    $baiviet->highlight = $baiviet->highlight ? 0 : 1;
                    $baiviet->save();
                    break;
            }
            return redirect()->back();
        }
    }
}
