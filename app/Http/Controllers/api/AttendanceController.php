<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\models\Staff\Staff;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceController extends Controller
{
    //勤怠状態のチェック
    public function checkAttendanceStatus(Request $request): JsonResponse
    {
       
        return response()->json(array(
            'status' => 'faild',
            'code' => 400,
            'data' => null,
            'message' => 'ログイン失敗',
    ));
    }

     //勤怠状態更新
     public function updateAttendanceStatus(Request $request): JsonResponse
     {

        $staff = new Staff();
        $staff -> updateAttendanceStatus($request->only([
            'user_id', 'attendance_state', 'push_time'
        ]));

        //勤怠時間を登録する処理が必要

         return response()->json(array(
            'status' => 'succese',
            'code' => 200,
            'message' => '',
    ));
     }
}
