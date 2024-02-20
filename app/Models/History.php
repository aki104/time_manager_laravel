<?php

namespace App\Models;

use App\Logics\service\StampingType;
use DateTime;
// use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'staff_id',
        'date',
        'start_time',
        'end_time'
    ];

    protected $table = 'historys';

    public function getHistory(array $request)
    {
    }

    //勤怠登録（出勤データ登録）
    public function createHistory(array $request, String $date)
    {
        // DB::table($this->table)->truncate();

      $result = DB::table($this->table)->insert([
            'staff_id' => $request['user_id'],
            'start_time' => new DateTime($request['push_time']),
            'end_time' => null,
            'date' => $date
        ]);

        return $result;
    }

    //勤怠登録(退勤データ登録)
    public function updateHistory(array $request, Builder $data)
    {
        // DB::table($this->table)->truncate();

        $result =  $data->update([
            'end_time' => new DateTime($request['push_time']),
        ]);

        return $result == 1;
    }

    public function register(StampingType $type, array $request)
    {
        $date = date('Y/m/d', strtotime($request['push_time']));
        $recode = DB::table($this->table)
            ->where([
                ['staff_id', '=', $request['user_id']],
                ['date', '=', $date]
            ]);

        $result = false;

        if ($type === StampingType::Register) {
            if ($recode->first() == null) {
                $result = $this->createHistory($request, $date);
            }
        } else {
            $result = $this->updateHistory($request, $recode);
        }

        return $result;
    }
}
