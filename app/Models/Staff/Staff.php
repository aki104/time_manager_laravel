<?php

namespace App\models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'company_code',
        'employee_code',
        'attendance_status'
    ];

    protected $table = 'staffs';

    //ログインしたスタッフのデータ取得
    public function getLoginStaff(array $request)
    {
        $employeeCode = $request['employee_code'] ?? null;
        $email = $request['email'] ?? null;
        $companyCode = $request['company_code'];
        $password = $request['password'];
        $emailOrCodeArray = $employeeCode != null ? ['employee_code', '=', $employeeCode] : ['email', '=', $email];

        $employeeData = DB::table($this->table)
            ->where([
                ['company_code', '=', $companyCode],
                $emailOrCodeArray,
                ['password', '=', $password]
            ])
            ->first();

        return $employeeData;
    }

    //勤怠情報更新
    public function updateAttendanceStatus(array $staffData)
    {
        $updateStatus = $staffData['attendance_state'] == 0 ? 1 : 0;
        $staffId = $staffData['user_id'];

        DB::table($this->table)
            ->where("id", (int) $staffId)
            ->update([
                "attendance_status" => (int) $updateStatus
            ]);
    }

    //勤怠状況取得
    public function getAttendanseStatus(array $request)
    {
        $staffId = $request['user_id'];
        $status = null;

        $staffData = DB::table($this->table)
            ->find((int) $staffId);

        if ($staffData != null) {
            $status =  $staffData->attendance_status;
        }

        return $status;
    }
}
