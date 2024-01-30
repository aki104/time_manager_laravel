<?php

namespace App\Logics\service;

use App\Logics\common\ReturnFormat;
use App\models\Staff\Staff;

class AccountService
{

    public function loginCHeck(array $request): array
    {

        $staff = new Staff();
        $data = $staff->getLoginData($request);
        $returnData = [];

        if ($data === null) {
            $returnData = ReturnFormat::failure(400, 'ログイン失敗');
        } else {
            $id = $data->id;
            $returnData = ReturnFormat::success(array(
                'user_id' => "$id",
                "auth_token" => "abcdefg"
            ), 200, '');
        }

        return $returnData;
    }
}
