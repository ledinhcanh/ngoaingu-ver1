<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaiLieuRequest;
use App\Models\BaiViet;
use App\Models\ChuyenMuc;
use App\Models\LoaiTaiLieu;
use App\Models\Muc;
use App\Models\NgonNgu;
use App\Models\NhaXuatBan;
use App\Models\TaiLieu;
use App\Models\User;
use Auth;
use File;
use App\Models\Lich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TaiLieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->mimes = new \Mimey\MimeTypes;
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
        $baiviet = BaiViet::where('status', 1)->whereIn('idchuyenmuc', [46, 48, 49, 50, 51, 52, 53])->orderBy('id', 'desc')->paginate(5);
        $baiviet1 = BaiViet::where('status', 1)->whereIn('idchuyenmuc', [46, 48, 49, 50, 51, 52, 53])->orderBy('id', 'desc')->paginate(3);
        $thongbao = BaiViet::Select('id', 'slug', 'title', 'content', 'updated_at', 'image')->where(['status' => 1, 'idchuyenmuc' => 45])->paginate(3);
        view()->share(['muc' => $muc, 'chuyenmuc' => $chuyenmuc, 'baiviet' => $baiviet, 'baiviet1' => $baiviet1, 'thongbao' => $thongbao, 'events' => $events, 'calendar' => $calendar]);
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->can('view', TaiLieu::class)) {
            $tailieu = TaiLieu::all();
            return view('admin.pages.tailieu.list', compact('tailieu'));
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
        if ($user->can('view', TaiLieu::class)) {
            $loaitailieu = LoaiTaiLieu::all();
            $ngonngu = NgonNgu::all();
            $nhaxuatban = NhaXuatBan::all();
            return view('admin.pages.tailieu.add', compact('loaitailieu', 'ngonngu', 'nhaxuatban'));
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
    public function store(TaiLieuRequest $request)
    {
        $user = Auth::user();
        if ($user->can('view', TaiLieu::class)) {

            // Step 1 - Upload hình đại diện
            if ($request->hasFile('image')) {
                $file_image = $request->image;
                //Lấy tên file
                $file_image_name = $file_image->getClientOriginalName();
                //Lấy loại file
                $file_image_type = $file_image->getMimeType();
                //Kích thước file với đơn vị byte
                $file_image_size = $file_image->getSize();
                if ($file_image_type == 'image/png' || $file_image_type == 'image/jpg' || $file_image_type == 'image/jpeg' || $file_image_type == 'image/gif') {
                    if ($file_image_size <= 2097152) {
                        $file_image_name = date('d-m-Y') . '-' . rand() . '-' . utf8tourl($file_image_name);

                    } else {
                        return back()->with('error', 'Bạn không thể upload ảnh quá 2mb');
                    }
                } else {
                    return back()->with('error', 'File bạn chọn không là hình ảnh');
                }
            }
            // Step 2 - Upload file
            if ($request->hasFile('attached')) {
                $file_attached = $request->attached;
                //Lấy tên file
                $file_attached_name = $file_attached->getClientOriginalName();
                //Lấy loại file
                $file_attached_type = $file_attached->getMimeType();
                //Kích thước file với đơn vị byte
                $file_attached_size = $file_attached->getSize();
                // Check từ request
                if ($file_attached_type == 'application/pdf' || $file_attached_type == 'application/msword' || $file_attached_type == 'application/vnd.ms-exce' || $file_attached_type == 'application/vnd.ms-powerpoint') {
                    if ($file_attached_size <= 104857600) {
                        $file_attached_name = date('d-m-Y') . '-' . rand() . '-' . utf8tourl($file_attached_name);
                        if ($file_attached->move('file/', $file_attached_name)) {
                            // Upload hình ảnh vào thư mục
                            $data = $request->all();
                            if (isset($file_image_name)) {
                                if ($file_image->move('img/upload/tailieu', $file_image_name)) {
                                    $data['image'] = $file_image_name;
                                }
                            }
                            // Insert Data
                            $data['format'] = $file_attached_type; // Insert định dạng file vào data
                            $data['file'] = $file_attached_name;
                            $data['idtaikhoan'] = $user->id;
                            $data['slug'] = utf8tourl($request->name); // Cắt slug
                            TaiLieu::create($data);
                            // Redirect
                            return redirect()->back()->with('thongbao', 'Đã thêm thành công');
                        }
                    } else {
                        return back()->with('error', 'Bạn không thể upload file quá 100mb');
                    }
                } else {
                    return back()->with('error', 'File bạn chọn không được cho phép');
                }
            } else {
                return back()->with('error', 'Bạn chưa thêm tiệp tin đính kèm');
            }
        } else {
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaiLieu  $taiLieu
     * @return \Illuminate\Http\Response
     */
    public function show(TaiLieu $taiLieu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaiLieu  $taiLieu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->can('view', TaiLieu::class)) {
            $tailieu = TaiLieu::findOrFail($id);
            $loaitailieu = LoaiTaiLieu::all();
            $ngonngu = NgonNgu::all();
            $nhaxuatban = NhaXuatBan::all();
            return view('admin.pages.tailieu.edit', compact('tailieu', 'loaitailieu', 'ngonngu', 'nhaxuatban'));
        } else {
            return view('errors.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaiLieu  $taiLieu
     * @return \Illuminate\Http\Response
     */
    public function update(TaiLieuRequest $request, $id)
    {
        $user = Auth::user();
        // Thêm dữ liệu từ page edit vào hàng chờ
        $data = $request->all();
        $tailieu = TaiLieu::find($id);
        // Check nếu có upload image
        if ($user->can('view', TaiLieu::class)) {

            // Step 1 - Upload hình đại diện
            if ($request->hasFile('image')) {
                $file_image = $request->image;
                //Lấy tên file
                $file_image_name = $file_image->getClientOriginalName();
                //Lấy loại file
                $file_image_type = $file_image->getMimeType();
                //Kích thước file với đơn vị byte
                $file_image_size = $file_image->getSize();
                if ($file_image_type == 'image/png' || $file_image_type == 'image/jpg' || $file_image_type == 'image/jpeg' || $file_image_type == 'image/gif') {
                    if ($file_image_size <= 2097152) {
                        $file_image_name = date('d-m-Y') . '-' . rand() . '-' . utf8tourl($file_image_name);
                        // Upload hình ảnh vào thư mục
                        if ($file_image->move('img/upload/tailieu', $file_image_name)) {
                            $data['image'] = $file_image_name;
                            if ($tailieu->image != 'file_no_img.png') {
                                if (File::exists('img/upload/tailieu/' . $tailieu->image)) {
                                    //Xóa file
                                    unlink('img/upload/tailieu/' . $tailieu->image);
                                }}
                        }
                    } else {
                        return back()->with('error', 'Bạn không thể upload ảnh quá 2mb');
                    }
                } else {
                    return back()->with('error', 'File bạn chọn không là hình ảnh');
                }
            }

            // Step 2 - Upload file
            if ($request->hasFile('attached')) {
                $file_attached = $request->attached;
                //Lấy tên file
                $file_attached_name = $file_attached->getClientOriginalName();
                //Lấy loại file
                $file_attached_type = $file_attached->getMimeType();
                //Kích thước file với đơn vị byte
                $file_attached_size = $file_attached->getSize();
                if ($file_attached_type == 'application/pdf' || $file_attached_type == 'application/msword' || $file_attached_type == 'application/vnd.ms-exce' || $file_attached_type == 'application/vnd.ms-powerpoint') {
                    if ($file_attached_size <= 104857600) {
                        $file_attached_name = date('H-i-s-d-m-Y') . '-' . rand() . '-' . utf8tourl($file_attached_name);
                        if ($file_attached->move('file/', $file_attached_name)) {
                            // Insert Data
                            $data['format'] = $file_attached_type; // Insert định dạng file vào data
                            $data['file'] = $file_attached_name;
                            if (File::exists('file/' . $tailieu->file)) {
                                //Xóa file
                                unlink('file/' . $tailieu->file);
                            }
                        }
                    } else {
                        return back()->with('error', 'Bạn không thể upload file quá 100mb');
                    }
                } else {
                    return back()->with('error', 'File bạn chọn không được cho phép');
                }
            }
            // Update Data - Nếu không chỉnh sửa file sẽ bỏ qua column file & image
            $data['idtaikhoan'] = $user->id; // Nhận ID từ tài khoản edit
            $data['slug'] = utf8tourl($request->name); // Cắt slug
            $tailieu->update($data); // Nhận dữ liệu từ hàng chờ vào database

            // Redirect
            return redirect()->back()->with('thongbao', 'Cập nhật thành công');

        } else {
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaiLieu  $taiLieu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->can('view', TaiLieu::class)) {
            $tailieu = TaiLieu::find($id);
            if ($tailieu) {
                if ($tailieu->image != 'file_no_img.png') {
                    if (File::exists('img/upload/tailieu/' . $tailieu->image)) {
                        unlink('img/upload/tailieu/' . $tailieu->image);
                    }}
                if (File::exists('file/' . $tailieu->file)) {
                    unlink('file/' . $tailieu->file);
                }
                $tailieu->delete();
                return back()->with('thongbao', 'Đã xóa thành công');
            }
        } else {
            return view('errors.403');
        }
    }

    public function tailieu($slug)
    {
        $chuyenmuc1 = ChuyenMuc::where('slug', $slug)->first();
        if ($chuyenmuc1 != null) {
            $chuyenmuc = ChuyenMuc::where('slug', $slug)->first();
            $loaitailieu = LoaiTaiLieu::where('name', $chuyenmuc1->name)->first();
            $tailieu = TaiLieu::Select('id', 'slug', 'name', 'description', 'file', 'view', 'download', 'updated_at', 'image')->where('idloaitailieu', $loaitailieu->id)->paginate(5);
            return view('client.pages.tailieu', compact('tailieu', 'chuyenmuc1', 'chuyenmuc'));
        } else {
            $tailieuKey = 'thaoluan_' . $slug;
            if (!Session::has($tailieuKey)) {
                TaiLieu::where('slug', $slug)->increment('view');
                Session::put($tailieuKey, 1);
            }
            $idtl = TaiLieu::where('slug', $slug)->first();
            $loaitailieu1 = LoaiTaiLieu::where('id', $idtl->idloaitailieu)->get();
            $tailieu = TaiLieu::Select('id', 'name', 'content', 'file', 'namxb', 'author', 'idnhaxuatban', 'updated_at', 'image')->where('slug', $slug)->first();
            return view('client.pages.dttailieu', compact('tailieu', 'loaitailieu1'));
        }
    }
    public function search(Request $request)
    {
        if ($request->isMethod('get')) {

            $type_search = $request->input('type-search');
            $keyword = $request->input('keyword');
            // Bài viết
            $baiviet = BaiViet::where('status', 1)->whereIn('idchuyenmuc', [46, 48, 49, 50, 51, 52, 53])->orderBy('id', 'desc')->paginate(3);
            $thongbao = BaiViet::Select('id', 'slug', 'title', 'content', 'updated_at', 'image')->where(['status' => 1, 'idchuyenmuc' => 45])->paginate(3);
            $muc = Muc::where('status', 1)->get();

            if ($type_search == 'name') {
                $total = TaiLieu::where('name', 'LIKE', '%' . $keyword . '%')->orWhere('description', 'LIKE', '%' . $keyword . '%')->count(); // Đếm kết quả
                $result = TaiLieu::where('name', 'LIKE', '%' . $keyword . '%')->orWhere('description', 'LIKE', '%' . $keyword . '%')->paginate(15); // Tìm trong tên hoặc mô tả
            } elseif ($type_search == 'author') {
                $total = TaiLieu::where('author', 'LIKE', '%' . $keyword . '%')->count(); // Đếm kết quả
                $result = TaiLieu::where('author', 'LIKE', '%' . $keyword . '%')->paginate(15); // Tìm trong tên tác giả
            }

            return view('client.pages.timkiemtailieu', compact('result', 'baiviet', 'thongbao', 'muc', 'keyword', 'total'));

        } else {
            return view('client.pages.timkiemtailieu', compact('baiviet', 'thongbao', 'muc')); // Page default
        }
    }
    public function download(Request $request)
    {
        $cat = $request->segment(2); // Nếu cần có thể check thêm loại tài liệu
        $id = $request->segment(3);
        $slug = $request->segment(4);

        // Check tài liệu có tồn tại hay k
        $check = TaiLieu::where(['id' => $id, 'slug' => $slug])->firstorfail();
        if (!$check) {
            return view('errors.404');
        } else {
            $tailieu = TaiLieu::findOrFail($id);

            DB::table('tailieu')
                ->where('id', $id)
                ->update(['download' => $tailieu->download + 1]);

            $file = "file/" . $tailieu->file;

            return response()->download($file); // Tự động download file về máy

        }
    }
    protected function search_by_file_type(Request $request)
    {
        $type = $this->mimes->getMimeType($request->segment(2));

        $total = TaiLieu::where('format', $type)->count(); // Đếm kết quả
        $result = TaiLieu::where('format', $type)->paginate(15);

        // Bài viết
        $baiviet = BaiViet::where('status', 1)->whereIn('idchuyenmuc', [46, 48, 49, 50, 51, 52, 53])->orderBy('id', 'desc')->paginate(3);
        $thongbao = BaiViet::Select('id', 'slug', 'title', 'content', 'updated_at', 'image')->where(['status' => 1, 'idchuyenmuc' => 45])->paginate(3);
        $muc = Muc::where('status', 1)->get();

        return view('client.pages.timkiemfiletailieu', compact('total', 'result', 'muc', 'thongbao', 'baiviet')); // Page default
    }

}
