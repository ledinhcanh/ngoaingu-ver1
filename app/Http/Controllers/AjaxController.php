<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muc;
use App\Models\ChuyenMuc;
use App\Models\Lop;
use App\Models\ChuyenNganh;

class AjaxController extends Controller
{
    public function getchuyenmuc(Request $request){
        $chuyemuc  = ChuyenMuc::where('idmuc',$request->idm)->get();
        return response()->json($chuyemuc, 200);
    }
    public function getlop(Request $request){
        $lop  = Lop::where('idchuyennganh',$request->idcn)->get();
        return response()->json($lop, 200);
    }
}
