<?php

namespace App\Logics\service;

use App\Logics\common\ReturnFormat;
use App\models\Staff\Staff;
class AttendanceService  {
    public function saveExecute(array $request): array {
        $staff = new Staff();
        $staff -> updateAttendanceStatus($request);
        return [];
    }

    public function fetchExecute(array $request): array {
        $staff = new Staff();
        $status = $staff -> fetchAttendanseStatus($request);
        $returnData = ReturnFormat::success(array(
            'attendance_state' => $status
        ), 200, '');
        return $returnData;
    }

    

}


