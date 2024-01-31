<?php

namespace App\Logics\service;

use App\Logics\common\ReturnFormat;
use App\Models\History;
use Illuminate\Support\Facades\Log;

class HistoryService  {
    
    public function registerExecute(array $request): array {
        $history = new History();
        $isStart = $request['attendance_state'] == 0;
        $returnData = [];
        $result = false;

        if ($isStart == true) {
            $result = $history -> register(StampingType::Register, $request);
        } else {
            $result = $history -> register(StampingType::Update, $request);
        }

        if ($result == true) {
            $returnData = ReturnFormat::success(array(null), 200, '');
        } else {
            $returnData = ReturnFormat::failure(405, '本日は退勤済みのため打刻できません');
        }

        
        return $returnData;
    }

}

//勤怠登録タイプ
enum StampingType {
    case Register;
    case Update;
}