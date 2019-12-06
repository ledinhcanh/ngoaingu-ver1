<?php

namespace App\Http\Controllers;

use App\Http\Requests\MucRequest;
use App\Models\Muc;
use Auth;
use Illuminate\Http\Request;

class MucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $muc = Muc::all();
        if ($user->can('view', Muc::class)) {
            return view('admin.pages.muc.list', compact("muc"));
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
        $muc = Muc::all();
        $user = Auth::user();
        if ($user->can('view', Muc::class)) {
            return view('admin.pages.muc.add');
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
    public function store(MucRequest $request)
    {
        $user = Auth::user();
        if ($user->can('view', Muc::class)) {
            $data = $request->all();
            $data['status'] = 1;
            $data['slug'] = utf8tourl($request->name);
            Muc::create($data);
            return redirect()->back()->with('thongbao', 'Đã thêm thành công');
        } else {
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Muc  $muc
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $muc = Muc::find($id);
        $muc->status = $muc->status ? 0 : 1;
        $muc->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Muc  $muc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->can('view', Muc::class)) {
            $muc = Muc::findOrFail($id);
            return view('admin.pages.muc.edit', compact("muc"));
        } else {
            return view('errors.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Muc  $muc
     * @return \Illuminate\Http\Response
     */
    public function update(MucRequest $request, $id)
    {
        $user = Auth::user();
        if ($user->can('view', Muc::class)) {
            $muc = Muc::find($id);
            $data = $request->all();
            $data['slug'] = utf8tourl($request->name);
            $muc->update($data);
            return redirect()->route('muc.index')->with('thongbao', 'Đã sửa thành công');
        } else {
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Muc  $muc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->can('view', Muc::class)) {
            $muc = Muc::find($id);
            if (count($muc->ChuyenMuc) === 0) {
                $muc->delete();
                return back()->with('thongbao', 'Đã xóa thành công');
            } else {
                return back()->with('error','Không thể xóa khi còn chuyên mục');
            }
        } else {
            return view('errors.403');
        }
    }
}
