<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChuyenNganh;
use App\Models\HocPhan;
use App\Models\HocKi;
use App\Models\HocPhan_TaiLieu;
use App\Models\TaiLieu;

class HocPhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dsmonhoc = HocPhan::all();
        return view('admin.pages.ctdaotao.list', compact('dsmonhoc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tailieu = TaiLieu::all();
        $hocki = HocKi::all();
        $chuyennganh = ChuyenNganh::all();
        return view('admin.pages.ctdaotao.add', compact('tailieu', 'hocki', 'chuyennganh'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name' => 'required|min:3',
            'code' => 'required',
            'number' => 'required',
            'idhocki' => 'required',
            'idchuyennganh' => 'required',
        ],
        [
            'name.required' => 'Bạn chưa nhập Tên học phần',
            'name.min' => 'Tên học phần tối thiểu 3 ký tự',
            'code.required' => 'Bạn chưa nhập mã học phần',
            'number.required' => 'Bạn chưa nhập số tín chỉ',
            'idhocki.required' => 'Bạn chưa chọn học kì',
            'idchuyennganh.required' => 'Bạn chưa chọn chuyên ngành',
        ]);
        $data = $request->all();
        $dsmonhoc = HocPhan::create($data);
        $dsmonhoc->TaiLieu()->attach($request->tailieu);
        return redirect()->back()->with('thongbao', 'Đã thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hocphan = HocPhan::findOrFail($id);
        $tailieu = TaiLieu::all();
        $hocki = HocKi::all();
        $chuyennganh = ChuyenNganh::all();
        $list = HocPhan_TaiLieu::where('hoc_phan_id', $id)->pluck('tai_lieu_id');
        return view('admin.pages.ctdaotao.edit', compact('tailieu', 'hocki', 'chuyennganh', 'hocphan', 'list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
            'name' => 'required|min:3',
            'code' => 'required',
            'number' => 'required',
            'idhocki' => 'required',
            'idchuyennganh' => 'required',
        ],
        [
            'name.required' => 'Bạn chưa nhập Tên học phần',
            'name.min' => 'Tên học phần tối thiểu 3 ký tự',
            'code.required' => 'Bạn chưa nhập mã học phần',
            'number.required' => 'Bạn chưa nhập số tín chỉ',
            'idhocki.required' => 'Bạn chưa chọn học kì',
            'idchuyennganh.required' => 'Bạn chưa chọn chuyên ngành',
        ]);
        $hocphan = HocPhan::find($id);
        $data = $request->all();
        $hocphan->update($data);
        $hocphan->TaiLieu()->sync($request->tailieu);
        return redirect()->route('ctdaotao.index')->with('thongbao', 'Cập nhật thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hocphan = HocPhan::find($id);
        if ($hocphan) {
            $hocphan->TaiLieu()->detach();
            $hocphan->delete();
            return back()->with('thongbao', 'Đã xóa thành công');
        }
    }
}
