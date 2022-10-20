<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PDF;

class MobileController extends Controller
{
    public function login(Request $request) {
        if (DB::table('users')->where('username', $request->username)->exists()) {
            if (Hash::check($request->password, DB::table('users')->where('username', $request->username)->value('password'))) {
                $date =  bcrypt(rand(100, 999).date('ymdHis'));
                $user_name = DB::table('users')->where('username', $request->username)->value('name');
                DB::table('users')->where('username', $request->username)->update(['token_login' => $date]);
                $department = DB::table('users')->leftJoin('department_list', 'users.department', '=', 'department_list.id')->where('users.username', $request->username)->value('department_list.department');
                return response([
                    'status' => 200,
                    'message' => "Success!!!",
                    'token' => $date,
                    'user' => $user_name,
                    'depart' => $department
                ]);
            } else {
                return response([
                    'status' => 500,
                    'message' => "Wrong Password"
                ]);
            }
        } else {
            return response([
                'status' => 500,
                'message' => "Account Not Found"
            ]);
        }
    }

    public function lotcard_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->exists()) {
            $data = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')
            ->leftJoin('quality', 'production.id', '=', 'quality.productionId')->leftJoin('users', 'quality.userId', '=', 'users.id')
            ->select('production.barcode as barcode', 'product.model_no as model_no', 'production.shift as shift', 'production.lotno as lotno', 'production.parts_data as parts',
            'production.date_1 as date_1', 'production.date_2 as date_2', 'production.name_1 as name_1', 'production.name_2 as name_2', 
            'production.fg_1 as finish_goods_1', 'production.fg_2 as finish_goods_2', 'production.ng_1 as no_goods_1', 'production.ng_2 as no_goods_2',
            'quality.judgement as judgement', 'users.name as checker_name')->get();
            return response([
                'data' => $data[0],
                'status' => 200
            ]);
        } else {            
            return response([
            'status' => 403,
            'message' => "Forbiden Access, Session Not Exists"
        ]);
        }
    }
    
    public function scaninspection_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->exists()) {
            $data = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')
            ->select('production.barcode as barcode', 'product.model_no as model_no', 'production.shift as shift', 'production.lotno as lotno', 'production.parts_data as parts',
            'production.date_1 as date_1', 'production.date_2 as date_2', 'production.name_1 as name_1', 'production.name_2 as name_2', 'production.status as status',
            'production.fg_1 as finish_goods_1', 'production.fg_2 as finish_goods_2', 'production.ng_1 as no_goods_1', 'production.ng_2 as no_goods_2', 'product.packing as packing')->get();
            $status = DB::table('production')->where('barcode', $request->id)->value('status');
            return response([
                'post' => $status,
                'data'   => $data[0],
                'status' => 200
            ]);
        } else {
            return response([
            'status' => 403,
            'message' => "Forbiden Access, Session Not Exists"
        ]);
        }
    }

    public function processinspection_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->where('department', 4)->exists()) {
            if (DB::table('production')->where('barcode', $request->id)->exists() && DB::table('production')->where('barcode', $request->id)->value('status') == 0) {
                if ($request->pcs_box == 0) {
                    return response([
                        'status' => 502,
                        'message' => "Error, Packing Size Input 0",
                        'type' => "pcs_box"
                    ]);
                }
                if ($request->totsbox == 0) {
                    return response([
                        'status' => 502,
                        'message' => "Error, Total Packing Input 0",
                        'type' => "totsbox"
                    ]);
                }
                if ($request->lotsize == 0) {
                    return response([
                        'status' => 502,
                        'message' => "Error, Lot Size Input 0",
                        'type' => "lotsize"
                    ]);
                }
                $productionId = DB::table('production')->where('barcode', $request->id)->value('id');
                $userId       = DB::table('users')->where('token_login',  $request->token)->value('id');
                DB::table('quality')->insert([
                    'productionId' => $productionId,
                    'judgement'    => $request->judgeme,
                    'remark'       => $request->remark != NULL ? $request->remark : "-",
                    'userId'       => $userId,
                ]);
                DB::table('production')->where('barcode', $request->id)->update([
                    'fg_1'   => $request->lotsize,
                    'fg_2'   => $request->totsbox,
                    'status' => 1
                ]);
                DB::table('product')->where('model_no', $request->model_no)->update([
                    'packing' => $request->pcs_box
                ]);
                $data = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')
                ->leftJoin('quality', 'production.id', '=', 'quality.productionId')->leftJoin('users', 'quality.userId', '=', 'users.id')
                ->select('production.barcode as barcode', 'product.model_no as model_no', 'product.packing as packing', 'production.shift as shift', 'production.lotno as lotno', 'production.parts_data as parts',
                'production.date_1 as date_1', 'production.date_2 as date_2', 'production.name_1 as name_1', 'production.name_2 as name_2', 'quality.remark as remark',
                'production.fg_1 as finish_goods_1', 'production.fg_2 as finish_goods_2', 'production.ng_1 as no_goods_1', 'production.ng_2 as no_goods_2',
                'quality.judgement as judgement', 'users.name as checker_name', 'product.section as section', 'product.line as line')->get();
                return response([
                    'data' => $data[0],
                    'status' => 200,
                    'message' => "Inspection Card Success Created"
                ]);
            } else {     
            return response([
                'status' => 500,
                'message' => "Error, Data Process Status Not Right "
            ]);
            }
        } else {            
            return response([
            'status' => 403,
            'message' => "Forbiden Access, Session Not Exists"
        ]);
        }
    }

    public function showinspection_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->where('department', 4)->exists()) {
            if (DB::table('production')->where('barcode', $request->id)->value('status') >= 1) {
                $data = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')
                ->leftJoin('quality', 'production.id', '=', 'quality.productionId')->leftJoin('users', 'quality.userId', '=', 'users.id')
                ->select('production.barcode as barcode','product.model_no as model_no', 'product.packing as packing', 'production.shift as shift', 'production.lotno as lotno', 'production.parts_data as parts',
                'production.date_1 as date_1', 'production.date_2 as date_2', 'production.name_1 as name_1', 'production.name_2 as name_2', 'quality.remark as remark',
                'production.fg_1 as finish_goods_1', 'production.fg_2 as finish_goods_2', 'production.ng_1 as no_goods_1', 'production.ng_2 as no_goods_2',
                'quality.judgement as judgement', 'users.name as checker_name', 'product.section as section', 'product.line as line')->get();
                return response([
                    'data' => $data[0],
                    'status' => 200,
                    'message' => "Activity Successfully Mounted"
                ]);
            } else {
                return response([
                    'status' => 500,
                    'message' => "Opps Something was Wrong!"
                ]);
            }
        } else {            
            return response([
            'status' => 403,
            'message' => "Forbiden Access, Session Not Exists"
        ]);
        }
    }

    public function scantransfers_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->where('department', 5)->exists()) {
            if (DB::table('production')->where('barcode', $request->id)->value('status') == 1) {
                $data = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')
                ->leftJoin('quality', 'production.id', '=', 'quality.productionId')->leftJoin('users', 'quality.userId', '=', 'users.id')
                ->select('production.barcode as barcode', 'product.model_no as model_no', 'production.shift as shift', 'production.lotno as lotno', 'production.parts_data as parts',
                'production.date_1 as date_1', 'production.date_2 as date_2', 'production.name_1 as name_1', 'production.name_2 as name_2', 
                'production.fg_1 as finish_goods_1', 'production.fg_2 as finish_goods_2', 'production.ng_1 as no_goods_1', 'production.ng_2 as no_goods_2',
                'quality.judgement as judgement', 'users.name as checker_name')->get();
                $status = DB::table('production')->where('barcode', $request->id)->value('status');
                return response([
                    'post' => $status,
                    'data' => $data[0],
                    'status' => 200
                ]);
            } else {
                return response([
                    'status' => 500,
                    'message' => "Opps Something was Wrong! Data Not Found"
                ]);
            }
        } else {            
            return response([
            'status' => 403,
            'message' => "Forbiden Access, Session Not Exists"
        ]);
        }
    }

    public function processtransfers_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->where('department', 5)->exists()) {
            if (DB::table('production')->where('barcode', $request->id)->value('status') == 1) {
                DB::table('production')->where('barcode', $request->id)->update([
                    'status' => 2
                ]);
                $productionId = DB::table('production')->where('barcode', $request->id)->value('id');
                $userId = DB::table('users')->where('token_login',  $request->token)->value('id');
                DB::table('transaction')->insert([
                    'productionId'   => $productionId,
                    'userId'         => $userId,
                    'referTransfers' => 0
                ]);
                return response([
                    'data' => $data[0],
                    'status' => 200
                ]);
            } else {
                return response([
                    'status' => 500,
                    'message' => "Opps Something was Wrong!"
                ]);
            }
        } else {            
            return response([
            'status' => 403,
            'message' => "Forbiden Access, Session Not Exists"
        ]);
        }
    }

    public function completetransaction_mobile() {
        if (DB::table('users')->where('token_login', $request->token)->where('department', 5)->exists()) {
                DB::table('production')->leftJoin('')->where('barcode', $request->id)->update([
                    'status' => 3
                ]);
                $productionId = DB::table('production')->where('barcode', $request->id)->value('id');
                $userId = DB::table('users')->where('token_login',  $request->token)->value('id');
                DB::table('transaction')->insert([
                    'productionId'   => $productionId,
                    'userId'         => $userId,
                    'referTransfers' => 0
                ]);
                return response([
                    'data' => $data[0],
                    'status' => 200
                ]);
        } else {            
            return response([
            'status' => 403,
            'message' => "Forbiden Access, Session Not Exists"
        ]);
        }
    }

    public function printlotcard_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->exists()) {
            if (DB::table('production')->where('barcode', $request->id)->value('status') >= 1) {
                $customPaper = array(0,0,245,500);
                $random = rand(10, 99);
                $record = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')
                ->select('production.id as id', 'production.barcode as barcode', 'product.model_no as model_no', 'production.lotno as lotno', 'production.shift as shift', 'production.parts_data as parts',
                'production.fg_1 as fg_1', 'production.fg_2 as fg_2', 'production.ng_1 as ng_1', 'production.ng_2 as ng_2', 'production.date_1 as date_1', 'production.date_2 as date_2', 'production.status as status',
                'production.name_1 as name_1', 'production.name_2 as name_2')
                ->get();
                $content = PDF::loadview('dll.detail_lotcard', ['data' => $record])->setPaper($customPaper)->download()->getOriginalContent();
                Storage::put('lotcard_'.$random.$request->id.'.pdf', $content);
                exec('lp /var/www/digipro/storage/app/lotcard_'.$random.$request->id.'.pdf -o fit-to-page');
                exec('rm /var/www/digipro/storage/app/lotcard_'.$random.$request->id.'.pdf');
                return response([
                    'status' => 200,
                    'message' => "Print Command Already Successfully sended"
                ]);
            } else {
                return response([
                    'status' => 500,
                    'message' => "Opps Something was Wrong!"
                ]);
            }
        } else {            
            return response([
            'status' => 403,
            'message' => "Forbiden Access, Session Not Exists"
        ]);
        }
    }
    
    public function printinspection_mobile(Request $request) {
        if (DB::table('users')->where('token_login', $request->token)->where('department', 4)->exists()) {
            if (DB::table('production')->where('barcode', $request->id)->value('status') == 1) {
                $customPaper = array(0,0,245,500);
                $random = rand(10, 99);
                $record = DB::table('production')->where('barcode', $request->id)->leftJoin('product', 'production.model_no', '=', 'product.id')->leftJoin('quality', 'quality.productionId', '=', 'production.id')
                ->select('production.id as id', 'production.barcode as barcode', 'product.model_no as model_no', 'production.lotno as lotno', 'production.shift as shift', 'production.parts_data as parts',
                'production.fg_1 as fg_1', 'production.fg_2 as fg_2', 'production.date_1 as date_1', 'production.date_2 as date_2', 'production.status as status', 'product.section as section', 'product.line as line',
                'production.name_1 as name_1', 'production.name_2 as name_2', 'quality.judgement as judgement', 'product.packing as packing', 'quality.date as date', 'quality.remark as remark')
                ->get();
                $content = PDF::loadview('dll.detail_inspection', ['data' => $record])->setPaper($customPaper)->download()->getOriginalContent();
                Storage::put('inspection_'.$random.$request->id.'.pdf', $content);
                exec('lp /var/www/digipro/storage/app/inspection_'.$random.$request->id.'.pdf -o fit-to-page');
                exec('rm /var/www/digipro/storage/app/inspection_'.$random.$request->id.'.pdf');
                return response([
                    'status' => 200,
                    'message' => "Print Command Already Successfully sended"
                ]);
            } else {
                return response([
                    'status' => 500,
                    'message' => "Opps Something was Wrong!"
                ]);
            }
        } else {            
            return response([
            'status' => 403,
            'message' => "Forbiden Access, Session Not Exists"
        ]);
        }
    }
}