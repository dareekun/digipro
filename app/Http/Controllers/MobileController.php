<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MobileController extends Controller
{
    public function login(Request $request) {
        if (DB::table('users')->where('username', $request->username)->exists()) {
            if (Hash::check($request->password, DB::table('users')->where('username', $request->username)->value('password'))) {
                $date =  bcrypt(date('YmdHis'));
                $user_name = DB::table('users')->where('username', $request->username)->value('name');
                DB::table('users')->where('username', $request->username)->update(['token_login' => $date]);
                return response([
                    'status' => 200,
                    'message' => "Success!!!",
                    'token' => $date,
                    'user' => $user_name
                    ]);
            } else {
                return response([
                    'status' => 500,
                    'message' => "Error!!!"
                    ]);
            }
        } else {
            return response([
                'status' => 500,
                'message' => "Error!!!"
                ]);
        }
    }

    public function lotcard_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->exists()) {
            $data = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')
            ->leftJoin('quality', 'production.id', '=', 'quality.productionId')->leftJoin('users', 'quality.userId', '=', 'users.id')
            ->select('product.model_no as model_no', 'production.shift as shift', 'production.lotno as lotno', 'production.parts_data as parts',
            'production.date_1 as date_1', 'production.date_2 as date_2', 'production.name_1 as name_1', 'production.name_2 as name_2', 
            'production.fg_1 as finish_goods_1', 'production.fg_2 as finish_goods_2', 'production.ng_1 as no_goods_1', 'production.ng_2 as no_goods_2',
            'quality.judgement as judgement', 'users.name as checker_name')->get();
            return response([
                'data' => $data[0],
                'status' => 200
            ]);
        } else {            
            return response([
            'status' => 500
        ]);
        }
    }
    public function scaninspection_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->exists()) {
            $data = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')
            ->select('production.barcode as barcode', 'product.model_no as model_no', 'production.shift as shift', 'production.lotno as lotno', 'production.parts_data as parts',
            'production.date_1 as date_1', 'production.date_2 as date_2', 'production.name_1 as name_1', 'production.name_2 as name_2', 'production.status as status',
            'production.fg_1 as finish_goods_1', 'production.fg_2 as finish_goods_2', 'production.ng_1 as no_goods_1', 'production.ng_2 as no_goods_2',)->get();
            return response([
                'data' => $data[0],
                'status' => 200
            ]);
        } else {            
            return response([
            'status' => 500
        ]);
        }
    }

    public function processinspection_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->exists()) {
            $data = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')
            ->leftJoin('quality', 'production.id', '=', 'quality.productionId')->leftJoin('users', 'quality.userId', '=', 'users.id')
            ->select('product.model_no as model_no', 'production.shift as shift', 'production.lotno as lotno', 'production.parts_data as parts',
            'production.date_1 as date_1', 'production.date_2 as date_2', 'production.name_1 as name_1', 'production.name_2 as name_2', 
            'production.fg_1 as finish_goods_1', 'production.fg_2 as finish_goods_2', 'production.ng_1 as no_goods_1', 'production.ng_2 as no_goods_2',
            'quality.judgement as judgement', 'users.name as checker_name')->get();
            return response([
                'data' => $data[0],
                'status' => 200
            ]);
        } else {            
            return response([
            'status' => 500
        ]);
        }
    }

    public function showinspection_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->exists()) {
            $data = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')
            ->leftJoin('quality', 'production.id', '=', 'quality.productionId')->leftJoin('users', 'quality.userId', '=', 'users.id')
            ->select('product.model_no as model_no', 'product.packing as packing', 'production.shift as shift', 'production.lotno as lotno', 'production.parts_data as parts',
            'production.date_1 as date_1', 'production.date_2 as date_2', 'production.name_1 as name_1', 'production.name_2 as name_2', 'quality.remark as remark',
            'production.fg_1 as finish_goods_1', 'production.fg_2 as finish_goods_2', 'production.ng_1 as no_goods_1', 'production.ng_2 as no_goods_2',
            'quality.judgement as judgement', 'users.name as checker_name')->get();
            return response([
                'data' => $data[0],
                'status' => 200
            ]);
        } else {            
            return response([
            'status' => 500
        ]);
        }
    }

    public function scantransfers_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->exists()) {
            $data = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')
            ->leftJoin('quality', 'production.id', '=', 'quality.productionId')->leftJoin('users', 'quality.userId', '=', 'users.id')
            ->select('product.model_no as model_no', 'production.shift as shift', 'production.lotno as lotno', 'production.parts_data as parts',
            'production.date_1 as date_1', 'production.date_2 as date_2', 'production.name_1 as name_1', 'production.name_2 as name_2', 
            'production.fg_1 as finish_goods_1', 'production.fg_2 as finish_goods_2', 'production.ng_1 as no_goods_1', 'production.ng_2 as no_goods_2',
            'quality.judgement as judgement', 'users.name as checker_name')->get();
            return response([
                'data' => $data[0],
                'status' => 200
            ]);
        } else {            
            return response([
            'status' => 500
        ]);
        }
    }
}