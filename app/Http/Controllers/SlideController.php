<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlideRequest;
use App\Models\Slide;
use Auth;
use File;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('view', Slide::class)) {
            $slide = Slide::all();
            return view('admin.pages.slide.list', compact('slide'));
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
        if ($user->can('view', Slide::class)) {
            return view('admin.pages.slide.add');
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
    public function store(SlideRequest $request)
    {
        $user = Auth::user();
        if ($user->can('view', Slide::class)) {
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
                        if ($file->move('img/upload/slide', $file_name)) {
                            $data = $request->all();
                            $data['image'] = $file_name;
                            $data['status'] = 1;
                            Slide::create($data);
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
        } else {
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slide = Slide::find($id);
        $slide->status = $slide->status ? 0 : 1;
        $slide->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->can('view', Slide::class)) {
            $slide = Slide::findOrFail($id);
            return view('admin.pages.slide.edit', compact('slide'));
        } else {
            return view('errors.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(SlideRequest $request, $id)
    {
        $user = Auth::user();
        if ($user->can('view', Slide::class)) {
            $slide = Slide::find($id);
            $data = $request->all();
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
                        if ($file->move('img/upload/slide', $file_name)) {
                            $data['image'] = $file_name;
                            if (File::exists('img/upload/slide/' . $slide->image)) {
                                //Xóa file
                                unlink('img/upload/slide/' . $slide->image);
                            }
                        }
                    } else {
                        return back()->with('error', 'Ảnh của bạn quá lớn chỉ được upload ảnh dưới 1mb');
                    }
                } else {
                    return back()->with('error', 'File bạn chọn không là hình ảnh');
                }
            } else {
                $data['image'] = $slide->image;
            }
            $slide->update($data);
            return redirect()->route('slide.index')->with('thongbao', 'Đã sửa thành công');
        } else {
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->can('view', Slide::class)) {
            $slide = Slide::find($id);
            if ($slide) {
                if (File::exists('img/upload/slide/' . $slide->image)) {
                    unlink('img/upload/slide/' . $slide->image);
                }
                $slide->delete();
                return back()->with('thongbao', 'Đã xóa thành công');
            }
        } else {
            return view('errors.403');
        }
    }
}
