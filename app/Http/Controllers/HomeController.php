<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\ChuyenMuc;
use App\Models\Muc;
use App\Models\Slide;
use Auth;
use App\Models\Lich;

class HomeController extends Controller
{
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
        $gioithieu = BaiViet::where(['status' => 1, 'idchuyenmuc' => 40])->first();
        // dd($gioithieu);
        $baiviet = BaiViet::where(['status' => 1, 'idchuyenmuc' => 46])->orderBy('id', 'desc')->paginate(3);
        $thongbao = BaiViet::where(['status' => 1, 'idchuyenmuc' => 45])->orderBy('id', 'desc')->paginate(10);
        $slide = Slide::where('status', 1)->orderBy('id', 'desc')->paginate(3);
        view()->share(['muc' => $muc, 'chuyenmuc' => $chuyenmuc, 'gioithieu' => $gioithieu, 'baiviet' => $baiviet, 'thongbao' => $thongbao, 'slide' => $slide, 'events' => $events, 'calendar' => $calendar]);
    }

    public function index()
    {
        return view('client.pages.index');
    }
    public function gioithieu()
    {
        return view('client.pages.gioithieu');
    }

}
