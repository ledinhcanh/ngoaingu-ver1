<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThaoLuanRequest;
use App\Models\BinhLuan;
use App\Models\ChuyenMuc;
use App\Models\GiangVien;
use App\Models\Muc;
use App\Models\Post_Tag;
use App\Models\SinhVien;
use App\Models\Tags;
use App\Models\ThaoLuan;
use App\Models\User;
use App\Models\Lich;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ThaoLuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $events = Lich::all();
        $event = [];
        foreach ($events as $row) {
            $enddate = $row->end_date."24:00:00";
             $event[] = \Calendar::event(
                $row->title,
                true,
                new \DateTime($row->start_date),
                new \DateTime($row->end_date),
                $row->id,
                [
                    'color' => $row->color,
                ]
             );
        } 
        $calendar = \Calendar::addEvents($event);
        $muc = Muc::where('status', 1)->get();
        $chuyenmuc = ChuyenMuc::where('status', 1)->get();
        view()->share(['muc' => $muc, 'chuyenmuc' => $chuyenmuc, 'events' => $events, 'calendar' => $calendar]);
    }

    public function index(Request $request)
    {
        if ($request->has('tags')) {
            $tag = Tags::find($request->tags);
            $thaoluan = $tag->ThaoLuan()->paginate(5);
        } else {
            $thaoluan = ThaoLuan::where('status', 1)->orderBy('created_at', 'desc')->paginate(5);
        }
        $tags = Tags::all();
        return view('client.pages.thaoluan.list', compact('thaoluan', 'tags'));
    }
    public function index1(Request $request)
    {
        $thaoluan = ThaoLuan::all();
        return view('admin.pages.baithaoluan.list', compact('thaoluan'));
    }
    public function detail($id)
    {
        $thaoluanKey = 'thaoluan_' . $id;
        if (!Session::has($thaoluanKey)) {
            ThaoLuan::where('id', $id)->increment('view');
            Session::put($thaoluanKey, 1);
        }
        $thaoluan = ThaoLuan::find($id);
        $taikhoan = User::where('id', $thaoluan->idtaikhoan)->first();
        $sinhvien = SinhVien::where('idtaikhoan', $taikhoan->id)->first();
        $giangvien = GiangVien::where('idtaikhoan', $taikhoan->id)->first();
        $tags = Tags::all();
        return view('client.pages.thaoluan.detail', compact('thaoluan', 'tags', 'sinhvien', 'giangvien'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tags::all();
        return view('client.pages.thaoluan.add', compact('tags'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThaoLuanRequest $request)
    {
        if (Auth::check()) {
            if ($request->hasFile('file')) {
                $file = $request->file;
                $file_name = $file->getClientOriginalName();
                $file_type = $file->getMimeType();
                $file_size = $file->getSize();
                if ($file_size <= 31457280) {
                    $file_name = str_random(4) . "_" . utf8tourl($file_name);
                    if ($file->move('file/thaoluan', $file_name)) {
                        $data = $request->all();
                        $data['file'] = $file_name;
                        $data['format'] = $file_type;
                        $data['status'] = 0;
                        $data['idtaikhoan'] = Auth::user()->id;
                        $baithaoluan = ThaoLuan::create($data);
                        $baithaoluan->Tags()->attach($request->tags);
                        return redirect()->route('thaoluan.index')->with('thongbaotl', 'Đăng bài thành công, vui lòng đợi xét duyệt');
                    }
                } else {return back()->with('error', 'Bạn không thể upload ảnh quá 30mb');}
            } else {
                $data = $request->all();
                $data['idtaikhoan'] = Auth::user()->id;
                $data['status'] = 0;
                $baithaoluan = ThaoLuan::create($data);
                $baithaoluan->Tags()->attach($request->tags);
                return redirect()->route('thaoluan.index')->with('thongbaotl', 'Đăng bài thành công, vui lòng đợi xét duyệt');
            }} else {
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ThaoLuan  $thaoLuan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thaoluan = ThaoLuan::find($id);
        $thaoluan->status = $thaoluan->status ? 0 : 1;
        $thaoluan->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ThaoLuan  $thaoLuan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thaoluan = ThaoLuan::find($id);
        $tags = Tags::all();
        $list = Post_Tag::where('thao_luan_id', $id)->pluck('tags_id');
        return view('client.pages.thaoluan.edit', compact('thaoluan', 'tags', 'list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ThaoLuan  $thaoLuan
     * @return \Illuminate\Http\Response
     */
    public function update(ThaoLuanRequest $request, $id)
    {
        if (Auth::check()) {
            $baithaoluan = ThaoLuan::find($id);
            $data = $request->all();
            if ($request->hasFile('file')) {
                $file = $request->file;
                //Lấy tên file
                $file_name = $file->getClientOriginalName();
                //Lấy loại file
                $file_type = $file->getMimeType();
                //Kích thước file với đơn vị byte
                $file_size = $file->getSize();

                if ($file_size <= 31457280) {
                    $file_name = str_random(4) . "_" . utf8tourl($file_name);
                    if ($file->move('file/thaoluan', $file_name)) {
                        $data['file'] = $file_name;
                        $data['format'] = $file_type;
                        if (File::exists('file/thaoluan/' . $baithaoluan->file)) {
                            //Xóa file
                            unlink('file/thaoluan/' . $baithaoluan->file);
                        }
                    }
                } else {
                    return back()->with('error', 'Ảnh của bạn quá lớn chỉ được upload ảnh dưới 30mb');
                }
            } else {
                $data['file'] = $baithaoluan->file;
            }
            $baithaoluan->update($data);
            $baithaoluan->Tags()->sync($request->tags);
            return redirect()->route('thaoluan.index')->with('thongbaotl', 'Sửa bài viết thành công');
        } else {
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ThaoLuan  $thaoLuan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $baithaoluan = ThaoLuan::find($id);
        if ($baithaoluan) {
            if ($baithaoluan->file) {
                if (File::exists('file/thaoluan/' . $baithaoluan->file)) {
                    unlink('file/thaoluan/' . $baithaoluan->file);
                }
            }
            $binhluan = BinhLuan::where('idbaithaoluan', $baithaoluan->id);
            $binhluan->delete();
            $baithaoluan->Tags()->detach();
            $baithaoluan->delete();
            return back()->with('thongbao', 'Xóa thành công');
        }
    }
    public function destroyclient($id)
    {
        $baithaoluan = ThaoLuan::find($id);
        if ($baithaoluan) {
            if ($baithaoluan->file) {
                if (File::exists('file/thaoluan/' . $baithaoluan->file)) {
                    unlink('file/thaoluan/' . $baithaoluan->file);
                }
            }
            $binhluan = BinhLuan::where('idbaithaoluan', $baithaoluan->id);
            $binhluan->delete();
            $baithaoluan->Tags()->detach();
            $baithaoluan->delete();
            return redirect()->route('thaoluan.index');
        }
    }
    public function timkiem(Request $request)
    {
        $keyword = $request->input('key');
        if ($request->has('tags')) {
            $tag = Tags::find($request->tags);
            $thaoluan = $tag->ThaoLuan()->paginate(5);
        } else {
            $thaoluan = ThaoLuan::where('title', 'LIKE', '%' . $keyword . '%')->where('status', 1)->paginate(5);
        }
        $tags = Tags::all();
        return view('client.pages.thaoluan.search', compact('thaoluan', 'keyword', 'tags'));
    }
}
