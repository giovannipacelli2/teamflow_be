<?php

namespace App\Swagger;

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

class AuthSwagger
{
    public function __construct()
    {
        //
    }
}
