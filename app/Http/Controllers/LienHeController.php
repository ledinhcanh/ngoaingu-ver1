<?php

namespace App\Http\Controllers;

use App\Models\LienHe;
use App\Models\ChuyenMuc;
use App\Models\Muc;
use App\Models\Lich;
use Illuminate\Http\Request;
use App\Http\Requests\LienHeRequest;

class LienHeController extends Controller
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
    public function index()
    {
        $lienhe = LienHe::all();
        return view('admin.pages.lienhe.list', compact('lienhe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.pages.lienhe');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LienHeRequest $request)
    {
        $data = $request->all();
        LienHe::create($data);
        return redirect()->back()->with('thongbaolh', 'Cảm ơn bạn đã gửi phản hồi cho chúng tôi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LienHe  $lienHe
     * @return \Illuminate\Http\Response
     */
    public function show(LienHe $lienHe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LienHe  $lienHe
     * @return \Illuminate\Http\Response
     */
    public function edit(LienHe $lienHe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LienHe  $lienHe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LienHe $lienHe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LienHe  $lienHe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lienhe = LienHe::find($id);
        if($lienhe){
            $lienhe->delete();
            return back()->with('thongbao', 'Đã xóa thành công');
        }
    }
}
