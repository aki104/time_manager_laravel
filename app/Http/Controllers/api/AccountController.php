<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Logics\service\AccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //ログイン
    public function login(Request $request): JsonResponse
    {
        $service = new AccountService();
        $loginCheckResponse = $service->loginCHeck($request->only([
            'name', 'company_code', 'employee_code', 'password', 'email'
        ]));
        $codeNumber = (int) $loginCheckResponse['code'];
        return response()->json($loginCheckResponse, $codeNumber);
    }
}
