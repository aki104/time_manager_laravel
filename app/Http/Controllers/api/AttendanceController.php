<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Logics\service\AttendanceService;
use App\Logics\service\HistoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceController extends Controller
{
    //勤怠状態のチェック
    public function detail(Request $request): JsonResponse
    {
        $attendanseService = new AttendanceService();
        $requestArray = $request->only([
            'user_id'
        ]);
        $response = $attendanseService->fetchExecute($requestArray);
        
        return response()->json($response);
    }

    //勤怠状態更新
    public function save(Request $request): JsonResponse
    {

        $attendanseService = new AttendanceService();
        $historyService = new HistoryService();
        $requestArray = $request->only([
            'user_id', 'attendance_state', 'push_time'
        ]);

        //勤怠時間登録
       $responseRegist = $historyService->registerExecute($requestArray);
       $codeNumber = (int) $responseRegist['code'];

       if ($codeNumber != 200) {
        return response()->json($responseRegist);
       }

        //勤怠状態保存
        $attendanseService->saveExecute($requestArray);

        return response()->json($responseRegist);
    }
}
