<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrangRequest;
use App\Models\Trang;
use File;
use Illuminate\Http\Request;

class TrangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trang = Trang::select('id', 'title', 'content', 'description', 'image', 'status')->get();
        return view('admin.pages.trang.list', compact('trang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.trang.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrangRequest $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->image;
            //Lấy tên file
            $file_name = $file->getClientOriginalName();
            //Lấy loại file
            $file_type = $file->getMimeType();
            //Kích thước file với đơn vị byte
            $file_size = $file->getSize();
            if ($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif') {
                if ($file_size <= 1048576) {
                    $file_name = date('D-m-yyyy') . '-' . rand() . '-' . utf8tourl($file_name);
                    if ($file->move('img/upload/trang', $file_name)) {
                        $data = $request->all();
                        $data['status'] = 1;
                        $data['slug'] = utf8tourl($request->title);
                        $data['image'] = $file_name;
                        Trang::create($data);
                        return redirect()->back()->with('thongbao', 'Đã thêm thành công');
                    }
                } else {
                    return back()->with('error', 'Bạn không thể upload ảnh quá 1mb');
                }
            } else {
                return back()->with('error', 'File bạn chọn không là hình ảnh');
            }
        } else {
            return back()->with('error', 'Bạn chưa thêm ảnh minh họa cho sản phẩm');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trang  $trang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trang = Trang::find($id);
        $trang->status = $trang->status ? 0 : 1;
        $trang->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trang  $trang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trang = Trang::findOrFail($id);
        return view('admin.pages.trang.edit', compact('trang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trang  $trang
     * @return \Illuminate\Http\Response
     */
    public function update(TrangRequest $request, $id)
    {
        $trang = Trang::find($id);
        $data = $request->all();
        $data['status'] = 1;
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
                if ($file_size <= 1048576) {
                    $file_name = date('D-m-yyyy') . '-' . rand() . '-' . utf8tourl($file_name);
                    if ($file->move('img/upload/trang', $file_name)) {
                        $data['image'] = $file_name;
                        if (File::exists('img/upload/trang/' . $trang->image)) {
                            //Xóa file
                            unlink('img/upload/trang/' . $trang->image);
                        }
                    }
                } else {
                    return back()->with('error', 'Ảnh của bạn quá lớn chỉ được upload ảnh dưới 1mb');
                }
            } else {
                return back()->with('error', 'File bạn chọn không là hình ảnh');
            }
        } else {
            $data['image'] = $trang->image;
        }
        $trang->update($data);
        return redirect()->route('trang.index')->with('thongbao', 'Đã sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trang  $trang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trang = Trang::find($id);
        if ($trang) {
            if (File::exists('img/upload/trang/'.$trang->image)) {
                unlink('img/upload/trang/'.$trang->image);
            }
            $trang->delete();
            return back()->with('thongbao', 'Đã xóa thành công');
        }
    }
}
