<?php

namespace App\Http\Controllers;

use App\Models\Lich;
use App\Models\Muc;
use App\Models\ChuyenMuc;
use App\Models\BaiViet;
use Illuminate\Http\Request;

class LichController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $muc = Muc::where('status', 1)->get();
        $chuyenmuc = ChuyenMuc::where('status', 1)->get();
        $baiviet1 = BaiViet::where('status', 1)->whereIn('idchuyenmuc', [46, 48, 49, 50, 51, 52, 53])->orderBy('id', 'desc')->take(3)->get();
        $thongbao = BaiViet::Select('id', 'slug', 'title', 'content', 'updated_at', 'image')->where(['status' => 1, 'idchuyenmuc' => 45])->take(3)->get();
        view()->share(['muc' => $muc, 'chuyenmuc' => $chuyenmuc, 'baiviet1' => $baiviet1, 'thongbao' => $thongbao]);
    }
   
    public function index()
    {
        $lich = Lich::all();
        return view('admin.pages.lich.list', compact('lich'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.lich.add');
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
                'title' => 'required',
                'color' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ],
            [
                'title.required' => 'Tiêu đề không được để trống',
                'color.required' => 'Màu không được để trống',
                'start_date.required' => 'Ngày bắt đầu không được để trống',
                'end_date.required' => 'Ngày kết thúc không được để trống',
            ]);
        $data = $request->all();
        Lich::create($data);
        return redirect()->back()->with('thongbao', 'Đã thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lich  $lich
     * @return \Illuminate\Http\Response
     */
    public function show(Lich $lich)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lich  $lich
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lich = Lich::findOrFail($id);
        return view('admin.pages.lich.edit', compact('lich'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lich  $lich
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'title' => 'required',
                'color' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ],
            [
                'title.required' => 'Tiêu đề không được để trống',
                'color.required' => 'Màu không được để trống',
                'start_date.required' => 'Ngày bắt đầu không được để trống',
                'end_date.required' => 'Ngày kết thúc không được để trống',
            ]);
        $lich = Lich::find($id);
        $data = $request->all();
        $lich->update($data);
        return redirect()->route('lich.index')->with('thongbao', 'Đã sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lich  $lich
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lich = Lich::find($id);
        $lich->delete();
        return back()->with('thongbao', 'Đã xóa thành công');
    }
}
