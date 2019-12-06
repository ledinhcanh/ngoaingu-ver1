<?php

namespace App\Http\Controllers;

use App\Models\LichTuan;
use File;
use Illuminate\Http\Request;
use App\Http\Requests\LichTuanRequest;

class LichTuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lichtuan = LichTuan::all();
        return view('admin.pages.lichtuan.list', compact('lichtuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.lichtuan.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LichTuanRequest $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file;
            //Lấy tên file
            $file_name = $file->getClientOriginalName();
            //Lấy loại file
            $file_type = $file->getMimeType();
            //Kích thước file với đơn vị byte
            $file_size = $file->getSize();
            if ($file_type == 'application/pdf' || $file_type == 'application/msword' || $file_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                if ($file_size <= 104857600) {
                    $file_name = date('D-m-yyyy') . '-' . rand() . '-' . utf8tourl($file_name);
                    if ($file->move('file/lichtuan', $file_name)) {
                        $data = $request->all();
                        $data['file'] = $file_name;
                        $data['slug'] = utf8tourl($request->title);
                        LichTuan::create($data);
                        return redirect()->back()->with('thongbao', 'Đã thêm thành công');
                    }
                } else {
                    return back()->with('error', 'Bạn không thể upload file quá 100mb');
                }
            } else {
                return back()->with('error', 'File bạn chọn không đúng');
            }
        }else {return back()->with('error', 'Vui lòng chọn file');}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LichTuan  $lichTuan
     * @return \Illuminate\Http\Response
     */
    public function show(LichTuan $lichTuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LichTuan  $lichTuan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lichtuan = LichTuan::findOrFail($id);
        return view('admin.pages.lichtuan.edit', compact('lichtuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LichTuan  $lichTuan
     * @return \Illuminate\Http\Response
     */
    public function update(LichTuanRequest $request, $id)
    {
        $lichtuan = LichTuan::find($id);
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file;
            //Lấy tên file
            $file_name = $file->getClientOriginalName();
            //Lấy loại file
            $file_type = $file->getMimeType();
            //Kích thước file với đơn vị byte
            $file_size = $file->getSize();
            if ($file_type == 'application/pdf' || $file_type == 'application/msword' || $file_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                if ($file_size <= 104857600) {
                    $file_name = date('D-m-yyyy') . '-' . rand() . '-' . utf8tourl($file_name);
                    if ($file->move('file/lichtuan', $file_name)) {
                        $data['file'] = $file_name;
                        if (File::exists('file/lichtuan/' . $lichtuan->file)) {
                            //Xóa file
                            unlink('file/lichtuan/' . $lichtuan->file);
                        }
                    }
                } else {
                    return back()->with('error', 'Bạn không thể upload file quá 100mb');
                }
            } else {
                return back()->with('error', 'File bạn chọn không đúng');
            }
        } else { $data['file'] = $lichtuan->file;}
        $data['slug'] = utf8tourl($request->title);
        $lichtuan->update($data);
        return redirect()->route('lichtuan.index')->with('thongbao', 'Cập nhật thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LichTuan  $lichTuan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lichtuan = LichTuan::find($id);
        if ($lichtuan) {
            if (File::exists('file/lichtuan/'.$lichtuan->file)) {
                unlink('file/lichtuan/'.$lichtuan->file);
            }
            $lichtuan->delete();
            return back()->with('thongbao', 'Đã xóa thành công');
        }
    }
}
