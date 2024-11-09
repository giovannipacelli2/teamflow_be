<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

    /**
    *
    *
    * @OA\Post(
    *     path="/api/login",
    *     summary="Login",
    *     description="Login with inserted credentials",
    *     operationId="login",
    *     tags={"auth"},
    *     @OA\RequestBody(
    *         required=true,
    *         description="JSON with account data",
    *         @OA\JsonContent(
    *             type="object",
    *              @OA\Property(
    *                  property="username", 
    *                  type="string", 
    *                  example="super", 
    *              ), 
    *              @OA\Property(
    *                  property="password", 
    *                  type="string", 
    *                  example="password", 
    *              ),
    *         ),
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Ok",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                 property="data",
    *                 type="object",
    *                 ref="#/components/schemas/Auth"
    *             ),
    *              @OA\Property(
    *                  property="message", 
    *                  type="string", 
    *              ),
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Not Authorized",
    *         @OA\JsonContent(
    *           type="object",
    *              @OA\Property(
    *                  property="status", 
    *                  type="string", 
    *                  example="error", 
    *              ), 
    *              @OA\Property(
    *                  property="message", 
    *                  type="string", 
    *                  example="Unauthorized", 
    *              ),
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server Error",
    *         @OA\JsonContent(
    *           type="object",
    *           @OA\Property(
    *               property="data",
    *               type="array",
    *               @OA\Items(
    *                   type="string"
    *               ),
    *           ),
    *           @OA\Property(
    *               property="message",
    *               type="string",
    *               example="Server error"
    *           ),
    *         )
    *     ),
    * ),
    *
    * @OA\Post(
    *     path="/api/logout",
    *     summary="Logout",
    *     description="logout with current account",
    *     operationId="logout",
    *     tags={"auth"},
    *     @OA\Response(
    *         response=200,
    *         description="Ok",
    *         @OA\JsonContent(
    *           type="object",
    *              @OA\Property(
    *                  property="data", 
    *                  type="array", 
    *                  @OA\Items(
    *                  ), 
    *              ), 
    *              @OA\Property(
    *                  property="message", 
    *                  type="string", 
    *                  example="Successfully logged out", 
    *              ),
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Not Authorized",
    *         @OA\JsonContent(
    *           type="object",
    *              @OA\Property(
    *                  property="status", 
    *                  type="string", 
    *                  example="error", 
    *              ), 
    *              @OA\Property(
    *                  property="message", 
    *                  type="string", 
    *                  example="Token not provided", 
    *              ),
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server Error",
    *         @OA\JsonContent(
    *           type="object",
    *           @OA\Property(
    *               property="data",
    *               type="array",
    *               @OA\Items(
    *                   type="string"
    *               ),
    *           ),
    *           @OA\Property(
    *               property="message",
    *               type="string",
    *               example="Log out unsuccess"
    *           ),
    *         )
    *     ),
    *   security={{"bearerAuth":{}}}
    * ),
    *
    * @OA\Get(
    *     path="/api/logged",
    *     summary="Logged",
    *     description="Check if user is logged",
    *     operationId="logged",
    *     tags={"auth"},
    *     @OA\Response(
    *         response=200,
    *         description="Ok",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                 property="data",
    *                 type="object",
    *                 ref="#/components/schemas/Logged"
    *             ),
    *             @OA\Property(
    *                 property="message", 
    *                 type="string", 
    *             ),
    *         ),
    *     ),
    *
    *     @OA\Response(
    *         response=401,
    *         description="Not Authorized",
    *         @OA\JsonContent(
    *           type="object",
    *              @OA\Property(
    *                  property="data", 
    *                  type="array", 
    *                  @OA\Items(
    *                      type="string"
    *                  ),
    *              ), 
    *              @OA\Property(
    *                  property="message", 
    *                  type="string", 
    *                  example="Token not provided", 
    *              ),
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server Error",
    *         @OA\JsonContent(
    *           type="object",
    *           @OA\Property(
    *               property="data",
    *               type="array",
    *               @OA\Items(
    *                   type="string"
    *               ),
    *           ),
    *           @OA\Property(
    *               property="message",
    *               type="string",
    *               example="Log out unsuccess"
    *           ),
    *         )
    *     ),
    *     security={{"bearerAuth":{}}}
    * ),
    *
    * @OA\Post(
    *     path="/api/refresh",
    *     summary="Refresh",
    *     description="Refresh token of current account",
    *     operationId="refresh",
    *     tags={"auth"},
    *     @OA\Response(
    *         response=200,
    *         description="Ok",
    *         @OA\JsonContent(
    *           type="object",
    *              @OA\Property(
    *                  property="data", 
    *                  type="object", 
    *                  @OA\Property(
    *                      property="status", 
    *                      type="string", 
    *                      example="success", 
    *                  ), 
    *                  @OA\Property(
    *                      property="accountId", 
    *                      type="string", 
    *                      example="8a2f56c2-5b5f-4b3f-996c-1774f33415cb", 
    *                  ), 
    *                  @OA\Property(
    *                      property="authorization", 
    *                      type="object", 
    *                      @OA\Property(
    *                          property="token", 
    *                          type="string", 
    *                          example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3JlZnJlc2giLCJpYXQiOjE3MjA0MjgyNjUsImV4cCI6MTcyMTAzMzA2NSwibmJmIjoxNzIwNDI4MjY1LCJqdGkiOiJyaEtabWt2eko0RmZCbDUyIiwic3ViIjoiOGEyZjU2YzItNWI1Zi00YjNmLTk5NmMtMTc3NGYzMzQxNWNiIiwicHJ2IjoiYzhlZTFmYzg5ZTc3NWVjNGM3Mzg2NjdlNWJlMTdhNTkwYjZkNDBmYyIsInJvbGUiOiJiY2IwOTVhYS1iZGU2LTQ1NWEtYTg0MS03NjExYzQzYWZjZWEifQ.A4JRY0cTfsn-aXJFJPPTk16ArAfdNN0FetKDcDpqrS8", 
    *                      ), 
    *                      @OA\Property(
    *                          property="type", 
    *                          type="string", 
    *                          example="bearer", 
    *                      ), 
    *                  ), 
    *              ), 
    *              @OA\Property(
    *                  property="message", 
    *                  type="string", 
    *              ),
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Not Authorized",
    *         @OA\JsonContent(
    *           type="object",
    *              @OA\Property(
    *                  property="status", 
    *                  type="string", 
    *                  example="error", 
    *              ), 
    *              @OA\Property(
    *                  property="message", 
    *                  type="string", 
    *                  example="Token not provided", 
    *              ),
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Server Error",
    *         @OA\JsonContent(
    *           type="object",
    *           @OA\Property(
    *               property="data",
    *               type="array",
    *               @OA\Items(
    *                   type="string"
    *               ),
    *           ),
    *           @OA\Property(
    *               property="message",
    *               type="string",
    *               example="Refresh unsuccess"
    *           ),
    *         )
    *     ),
    *   security={{"bearerAuth":{}}}
    * ),
    *
    *
    * @OA\Schema(
    *     schema="Auth",
    *     type="object",
    *     properties={
    *       @OA\Property(
    *           property="status", 
    *           type="string", 
    *           example="success", 
    *       ), 
    *       @OA\Property(
    *           property="accountId", 
    *           type="string", 
    *           example="8a2f56c2-5b5f-4b3f-996c-1774f33415cb", 
    *       ), 
    *       @OA\Property(
    *           property="authorization", 
    *           type="object", 
    *           @OA\Property(
    *               property="token", 
    *               type="string", 
    *               example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzIwNDI3NDE1LCJleHAiOjE3MjEwMzIyMTUsIm5iZiI6MTcyMDQyNzQxNSwianRpIjoiYXlGakZMcFBmaWlZRFV4YSIsInN1YiI6IjhhMmY1NmMyLTViNWYtNGIzZi05OTZjLTE3NzRmMzM0MTVjYiIsInBydiI6ImM4ZWUxZmM4OWU3NzVlYzRjNzM4NjY3ZTViZTE3YTU5MGI2ZDQwZmMiLCJyb2xlIjoiYmNiMDk1YWEtYmRlNi00NTVhLWE4NDEtNzYxMWM0M2FmY2VhIn0.r1SGjTg7GpiJjiN778yU2NKv39c8G4WmMKJAs9lW_5A", 
    *           ), 
    *           @OA\Property(
    *               property="type", 
    *               type="string", 
    *               example="bearer", 
    *           ), 
    *       ), 
    *     },
    * ),
    * 
    * @OA\Schema(
    *     schema="Logged",
    *     type="object",
    *     properties={
    *       @OA\Property(
    *           property="logged", 
    *           type="bool", 
    *           example=true, 
    *       ), 
    *       @OA\Property(
    *           property="account", 
    *           type="object",
    *           ref="#/components/schemas/AccountResponse"
    *       ), 
    *     },
    * ), 
    */

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
