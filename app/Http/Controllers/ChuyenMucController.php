<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChuyenMucRequest;
use App\Models\ChuyenMuc;
use App\Models\Muc;
use Auth;
use Illuminate\Http\Request;

class ChuyenMucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('view', ChuyenMuc::class)) {
            $chuyenmuc = ChuyenMuc::all();
            return view('admin.pages.chuyenmuc.list', compact("chuyenmuc"));
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
        if ($user->can('view', ChuyenMuc::class)) {
            $muc = Muc::where('status', 1)->get();
            return view('admin.pages.chuyenmuc.add', compact("muc"));
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
    public function store(ChuyenMucRequest $request)
    {
        $user = Auth::user();
        if ($user->can('view', ChuyenMuc::class)) {
            $data = $request->all();
            $data['status'] = 1;
            $data['slug'] = utf8tourl($request->name);
            ChuyenMuc::create($data);
            return redirect()->back()->with('thongbao', 'Đã thêm thành công');
        } else {
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChuyenMuc  $chuyenMuc
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chuyenmuc = ChuyenMuc::find($id);
        $chuyenmuc->status = $chuyenmuc->status ? 0 : 1;
        $chuyenmuc->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChuyenMuc  $chuyenMuc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->can('view', ChuyenMuc::class)) {
            $chuyenmuc = ChuyenMuc::findOrFail($id);
            $muc = Muc::where('status', 1)->get();
            return view('admin.pages.chuyenmuc.edit', compact('chuyenmuc', 'muc'));
        } else {
            return view('errors.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChuyenMuc  $chuyenMuc
     * @return \Illuminate\Http\Response
     */
    public function update(ChuyenMucRequest $request, $id)
    {
        $user = Auth::user();
        if ($user->can('view', ChuyenMuc::class)) {
            $chuyenmuc = ChuyenMuc::find($id);
            $muc = Muc::all();
            $data = $request->all();
            $data['slug'] = utf8tourl($request->name);
            $chuyenmuc->update($data);
            return redirect()->route('chuyenmuc.index')->with('thongbao', 'Đã sửa thành công');
        } else {
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChuyenMuc  $chuyenMuc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->can('view', ChuyenMuc::class)) {
            $chuyenmuc = ChuyenMuc::find($id);
            if (count($chuyenmuc->BaiViet) === 0) {
                $chuyenmuc->delete();
                return back()->with('thongbao', 'Đã xóa thành công');
            } else {return back()->with('error', 'Không thể xóa khi còn chuyên mục');}
        } else {
            return view('errors.403');
        }
    }
}
