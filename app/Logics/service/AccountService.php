<?php

namespace App\Logics\service;

use App\models\Staff\Staff;

class AccountService {

    public function loginCHeck(array $request): array {

        $staff = new Staff();
        $data = $staff->getdata($request);
        $returnData = [];

        if ($data === null) {
             $returnData = array(
                'status' => 'faild',
                'code' => 400,
                'data' => null,
                'message' => 'ログイン失敗',
        );
            
        } else {
            $id = $data->id;
            $returnData = array(
                'status' => 'success',
                'code' => 200,
                'data' => array(
                    'user_id'=>"$id",
                    "auth_token" => "abcdefg"
                ),
                'message' => '',
        );
        }

        return $returnData;
    }

   
}