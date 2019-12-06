<?php

namespace App\Http\Controllers;

use App\Http\Requests\LopRequest;
use App\Models\ChuyenNganh;
use App\Models\Lop;
use Illuminate\Http\Request;

class LopController extends Controller
{
    public function index()
    {
        $lop = Lop::all();
        return view('admin.pages.lop.list', compact("lop"));
    }

    public function create()
    {
        $chuyennganh = ChuyenNganh::all();
        return view('admin.pages.lop.add', compact("chuyennganh"));
    }

    public function store(LopRequest $request)
    {
        $data = $request->all();
        Lop::create($data);
        return redirect()->back()->with('thongbao', 'Đã thêm thành công');
    }

    public function edit($id)
    {
        $lop = Lop::findOrFail($id);
        $chuyennganh = ChuyenNganh::all();
        return view('admin.pages.lop.edit', compact('lop', 'chuyennganh'));
    }

    public function update(LopRequest $request, $id)
    {
        $lop = Lop::find($id);
        $data = $request->all();
        $lop->update($data);
        return redirect()->route('lop.index')->with('thongbao', 'Đã sửa thành công');
    }

    public function destroy(Request $request, $id)
    {
        $lop = Lop::find($id);
        if ($lop) {
            $lop->delete();
        }
        if ($request->ajax()) {
            return response()->json(['success' => 'Xóa thành công'], 200);
        }
    }
}
