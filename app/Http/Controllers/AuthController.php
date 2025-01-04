<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{    
    private static $accessTokenTime = 7 * 24 * 60 * 60;  //1 week

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('username', 'password');

        if (filter_var($credentials['username'], FILTER_VALIDATE_EMAIL)){
            $credentials['email']=$credentials['username'];
            unset($credentials['username']);
        }

        $isAuth = Auth::attempt($credentials);

        if (!$isAuth) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $accountId = Auth::user()['id'];

        $payload = [
            'exp' => time() + static::$accessTokenTime
        ];

        $token = $this->addToToken($payload);

        $result = ResponseJson::format([
            'status' => 'success',
            'accountId' => $accountId,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);

        return response()->json($result, 200);
    }

    public function logout()
    {
        try {
            Auth::logout();
        } catch (\Exception $e) 
        {
            $result = ResponseJson::format([], 'Log out unsuccess');
            return response()->json($result, 500);
        }

        $result = ResponseJson::format([], 'Successfully logged out');
        return response()->json($result, 200);
    }

    public function isLogged(){
        $auth = Auth::user();

        if (!$auth){
            $result = ResponseJson::format([], 'Not Logged');
            return response()->json($result, 401);
        }

        $res = [
            'logged' => true,
            'account' => $auth = Auth::user()
        ];

        $result = ResponseJson::format($res, '');
        return response()->json($result, 200);
    }

    public function refresh()
    {

        $payload = [
            'exp' => time() + static::$accessTokenTime
        ];

        $refresh = Auth::refresh();

        if (!$refresh) {
            $result = ResponseJson::format([], 'Refresh unsuccess');
            return response()->json($result, 500);
        }

        $token = $this->addToToken($payload);
        $accountId = Auth::user()['id'];

        $result = ResponseJson::format([
            'status' => 'success',
            'accountId' => $accountId,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);

        return response()->json($result, 200);
    }

    /*-----------------------------------------PRIVATE-FUNCTIONS-----------------------------------------*/

    private function addToToken(array $customPayload = []): String
    {

        $account = Auth::user();

        $payload = [
            'role' => $account->role_id, // add account role
            ...$customPayload
        ];

        try {
            // Genera il token con i claims personalizzati
            if (!$token = JWTAuth::claims($payload)->fromUser($account)) {
                return response()->json(['error' => 'Could not create token'], 500);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
        return $token;
    }
}
