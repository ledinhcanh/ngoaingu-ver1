<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use Auth;
use Illuminate\Http\Request;
use Validator;

class BinhLuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\BinhLuan  $binhLuan
     * @return \Illuminate\Http\Response
     */
    public function show(BinhLuan $binhLuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BinhLuan  $binhLuan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $binhluan = BinhLuan::find($id);
        return response()->json($binhluan, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BinhLuan  $binhLuan
     * @return \Illuminate\Http\Response
     */
    public function postcreate(Request $request, $id)
    {
        $this->validate($request,
            [
                'content' => 'required',
            ],
            [
                'content.required' => 'Nội dung không được để trống',
            ]);
        $binhluan = new BinhLuan;
        $binhluan->idbaithaoluan = $id;
        $binhluan->idtaikhoan = Auth::user()->id;
        $binhluan->content = $request->content;
        $binhluan->save();
        return redirect("thao-luan/bai-dang/$id");
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'content' => 'required',
            ],
            [
                'content.required' => 'Nội dung không được để trống',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'true', 'message' => $validator->errors()], 200);
        }
        $binhluan = BinhLuan::find($id);
        $binhluan->update(
            [
                'content' => $request->content,
            ]
        );
        return response()->json(['success' => 'Sửa thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BinhLuan  $binhLuan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BinhLuan::destroy($id);
        return back();
    }
}
