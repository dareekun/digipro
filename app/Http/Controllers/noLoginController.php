<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\PWKExports;
use Maatwebsite\Excel\Facades\Excel;

class noLoginController extends Controller
{
    public function pwk(Request $request) {
        return Excel::download(new PWKExports($request->tahuninput,$request->lineproduksi), $request->tahuninput.'PWK - '.$request->lineproduksi.'.xlsx');
    }
}
