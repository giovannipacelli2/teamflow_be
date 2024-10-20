<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Account;

// Custom static class
use App\Include\ApiFunctions;
use App\Include\SortFilter;
use App\Translations\Translations;

/**
 *  @OA\Info(
 *      title="DietaIntegrata", 
 *      version="0.8",
 *  ),
 *  
 *  @OA\Server(
 *     url="http://localhost:8000",
 *     description="API Server"
 * ),
 * 
 *  @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * ),
 * 
 * @OA\Get(
 *     path="/api/account/all",
 *     summary="Get all accounts data",
 *     operationId="getAllAccounts",
 *     tags={"account"},
 *     @OA\Parameter(
 *         name="limit",
 *         in="query",
 *         description="Limit of elements",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *             example=10
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="Current page",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *             example=1
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="sortBy",
 *         in="query",
 *         description="sort by element",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example="username"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="sortValue",
 *         in="query",
 *         description="sorting type",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example="ascend"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="filterBy",
 *         in="query",
 *         description="fields to filter",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example="name"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="filterValue",
 *         in="query",
 *         description="Values to filter",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example="ma"
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            type="object",
 *            @OA\Property(
 *                property="data", 
 *                type="object", 
 *                ref="#/components/schemas/AccountsResponse"
 *             ),    
 *            @OA\Property(
 *              property="message", 
 *              type="string", 
 *            ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Not Authorized",
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
 *               example="Not Authorized"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbitten",
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
 *               example="Not Authorized"
 *           ),
 *         )
 *     ),
 *     
 *     security={{"bearerAuth":{}}}
 * ),
 * 
 * @OA\Get(
 *     path="/api/account/{accountId}",
 *     summary="Get data of a single account",
 *     operationId="getAccount",
 *     tags={"account"},
 *     @OA\Parameter(
 *         name="accountId",
 *         in="path",
 *         description="model id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="59e7626e-49bf-4e63-b195-f4d826af8ad8"
 *         ),
 *     ),
 *     
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="data", 
 *                 type="object", 
 *                 ref="#/components/schemas/AccountResponse"
 *             ), 
 *             @OA\Property(
 *                 property="message", 
 *                 type="string", 
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Not Authorized",
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
 *               example="Not Authorized"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbitten",
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
 *               example="Not Authorized"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found",
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
 *               example="Account not found"
 *           ),
 *         )
 *     ),
 *     security={{"bearerAuth":{}}}
 * ),
 * 
 * @OA\Get(
 *     path="/api/account/{accountId}/info",
 *     summary="Get info of a single account",
 *     operationId="getAccountInfo",
 *     tags={"account"},
 *     @OA\Parameter(
 *         name="accountId",
 *         in="path",
 *         description="model id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="59e7626e-49bf-4e63-b195-f4d826af8ad8"
 *         ),
 *     ),
 *     
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="data", 
 *                 type="object", 
 *                 ref="#/components/schemas/AccountInfoResponse"
 *             ), 
 *             @OA\Property(
 *                 property="message", 
 *                 type="string", 
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Not Authorized",
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
 *               example="Not Authorized"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbitten",
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
 *               example="Not Authorized"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found",
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
 *               example="Account not found"
 *           ),
 *         )
 *     ),
 *     security={{"bearerAuth":{}}}
 * ),
 * 
 * @OA\Post(
 *     path="/api/account",
 *     summary="Create new account",
 *     description="",
 *     operationId="createAccount",
 *     tags={"account"},
 *     @OA\RequestBody(
 *         required=true,
 *         description="JSON with account data",
 *         @OA\JsonContent(
 *             type="object",
 *             ref="#/components/schemas/AccountBodyReq"
 *         )
 *     ),
 *     
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(
 *           type="object",
 *           @OA\Property(
 *               property="data", 
 *               type="object", 
 *               @OA\Property(
 *                   property="id", 
 *                   type="string", 
 *                   example="1a2d4d27-43d1-4450-9ed0-5c4e7b802dae", 
 *               ), 
 *           ), 
 *           @OA\Property(
 *               property="message", 
 *               type="string", 
 *               example="Account created successfully", 
 *           ),
 *         )
 *     ),
 *     
 *     @OA\Response(
 *         response=400,
 *         description="Bad request",
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
 *               example="Bad request"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Not Authorized",
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
 *               example="Not Authorized"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbitten",
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
 *               example="Not Authorized"
 *           ),
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
 *               example="Insert unsuccess"
 *           ),
 *         )
 *     ),
 *     security={{"bearerAuth":{}}}
 * ),
 * 
 * @OA\Put(
 *     path="/api/account/{accountId}",
 *     summary="Update a specific account",
 *     description="",
 *     operationId="updateAccount",
 *     tags={"account"},
 *     @OA\Parameter(
 *         name="accountId",
 *         in="path",
 *         description="model id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="c7817f8f-3539-46c9-a5ec-b85227bb4e07"
 *         ),
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="JSON with account data",
 *         @OA\JsonContent(
 *             type="object",
 *             ref="#/components/schemas/AccountBodyReq"
 *         )
 *     ),
 *     
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(
 *           type="object",
 *           @OA\Property(
 *               property="data", 
 *               type="array", 
 *               @OA\Items(
 *               ), 
 *           ), 
 *           @OA\Property(
 *               property="message", 
 *               type="string", 
 *               example="Update Success", 
 *           ),
 *         )
 *     ),
 *     
 *     @OA\Response(
 *         response=400,
 *         description="Bad request",
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
 *               example="Bad request"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Not Authorized",
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
 *               example="Not Authorized"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbitten",
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
 *               example="Not Authorized"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Inserted model not exists",
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
 *               example="Account not found"
 *           ),
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
 *               example="Insert unsuccess"
 *           ),
 *         )
 *     ),
 *     security={{"bearerAuth":{}}}
 * ),
 * 
 * @OA\Delete(
 *     path="/api/account/{accountId}",
 *     summary="Delete an existing account",
 *     description="",
 *     operationId="deleteAccount",
 *     tags={"account"},
 *     @OA\Parameter(
 *         name="accountId",
 *         in="path",
 *         description="Account id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="c7817f8f-3539-46c9-a5ec-b85227bb4e07"
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="success",
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
 *               example="Delete success"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request",
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
 *               example="Bad request"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Not Authorized",
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
 *               example="Not Authorized"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbitten",
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
 *               example="Not Authorized"
 *           ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
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
 *               example="Account not found"
 *           ),
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
 *               example="Delete unsuccess"
 *           ),
 *         )
 *     ),
 *     security={{"bearerAuth":{}}}
 * ),
 * 
 * 
 * @OA\Schema(
 *   schema="AccountResponse",
 *   type="object",
 *   properties={
 *     @OA\Property(
 *         property="id", 
 *         type="string", 
 *         example="59e7626e-49bf-4e63-b195-f4d826af8ad8", 
 *     ), 
 *     @OA\Property(
 *         property="username", 
 *         type="string", 
 *         example="agent", 
 *     ), 
 *     @OA\Property(
 *         property="name", 
 *         type="string", 
 *         example="Luca", 
 *     ), 
 *     @OA\Property(
 *         property="surname", 
 *         type="string", 
 *         example="La Porta", 
 *     ), 
 *     @OA\Property(
 *         property="email", 
 *         type="string", 
 *         example="agent@dev.com", 
 *     ), 
 *   },
 * ),
 * 
 *  @OA\Schema(
 *   schema="AccountInfoResponse",
 *   type="object",
 *   properties={
 *     @OA\Property(
 *         property="name", 
 *         type="string", 
 *         example="Luca", 
 *     ), 
 *     @OA\Property(
 *         property="surname", 
 *         type="string", 
 *         example="La Porta", 
 *     ), 
 *   },
 * ),
 * 
 * 
 * @OA\Schema(
 *   schema="AccountsResponse",
 *   type="object",
 *   properties={
 *     @OA\Property(
 *         property="current_page", 
 *         type="number", 
 *         example=1,
 *     ), 
 *     @OA\Property(
 *         property="data", 
 *         type="array", 
 *         @OA\Items(
 *             type="object",
 *             ref="#/components/schemas/AccountResponse"
 *         ), 
 *     ), 
 *     @OA\Property(
 *         property="first_page_url", 
 *         type="string", 
 *         example="http://localhost:8000/api/account/all?page=1", 
 *     ), 
 *     @OA\Property(
 *         property="from", 
 *         type="number", 
 *         example=1,
 *     ), 
 *     @OA\Property(
 *         property="last_page", 
 *         type="number", 
 *         example=1,
 *     ), 
 *     @OA\Property(
 *         property="last_page_url", 
 *         type="string", 
 *         example="http://localhost:8000/api/account/all?page=1", 
 *     ), 
 *     @OA\Property(
 *         property="links", 
 *         type="array", 
 *         @OA\Items(
 *             type="object", 
 *             @OA\Property(
 *                 property="url", 
 *                 format="nullable", 
 *                 type="string", 
 *             ), 
 *             @OA\Property(
 *                 property="label", 
 *                 type="string", 
 *                 example="pagination.previous", 
 *             ), 
 *             @OA\Property(
 *                 property="active", 
 *                 type="boolean", 
 *             ), 
 *         ), 
 *     ), 
 *     @OA\Property(
 *         property="next_page_url", 
 *         format="nullable", 
 *         type="string", 
 *     ), 
 *     @OA\Property(
 *         property="path", 
 *         type="string", 
 *         example="http://localhost:8000/api/account/all", 
 *     ), 
 *     @OA\Property(
 *         property="per_page", 
 *         type="number", 
 *         example=10,
 *     ), 
 *     @OA\Property(
 *         property="prev_page_url", 
 *         format="nullable", 
 *         type="string", 
 *     ), 
 *     @OA\Property(
 *         property="to", 
 *         type="number", 
 *         example=1,
 *     ), 
 *     @OA\Property(
 *         property="total", 
 *         type="number", 
 *         example=1,
 *     ),
 *   }),
 * ),
 *   
 * 
 * @OA\Schema(
 *   schema="AccountBodyReq",
 *   type="object",
 *   properties={
 *    @OA\Property(
 *        property="username", 
 *        type="string", 
 *        example="john10", 
 *    ), 
 *    @OA\Property(
 *        property="name", 
 *        type="string", 
 *        example="John", 
 *    ), 
 *    @OA\Property(
 *        property="surname", 
 *        type="string", 
 *        example="Doe", 
 *    ), 
 *    @OA\Property(
 *        property="email", 
 *        type="string", 
 *        example="johndow@email.com", 
 *    ), 
 *    @OA\Property(
 *        property="password", 
 *        type="string", 
 *        example="abc1234", 
 *    ), 
 * }),
 *  
 * @OA\Get(
 *     path="/",
 *     summary="params",
 *     operationId="",
 *     tags={"params"},
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             type="object",
 *             ref="#/components/schemas/sortFilterParams"
 *         ),
 *     ),
 *     security={{"bearerAuth":{}}}
 * ),
 * 
 * @OA\Schema(
 *   schema="sortFilterParams",
 *   type="object",
 *   properties={
 *     @OA\Property(
 *         property="limit", 
 *         type="integer",
 *     ), 
 *     @OA\Property(
 *         property="page", 
 *         type="integer",
 *     ), 
 *     @OA\Property(
 *         property="sortBy", 
 *         type="string",
 *     ), 
 *     @OA\Property(
 *         property="sortValue", 
 *         type="string",
 *     ), 
 *     @OA\Property(
 *         property="filterBy", 
 *         type="string",
 *     ), 
 *     @OA\Property(
 *         property="filterValue", 
 *         type="string",
 *     ), 
 *     @OA\Property(
 *         property="start", 
 *         type="string",
 *     ), 
 *     @OA\Property(
 *         property="end", 
 *         type="string",
 *     ), 
 *   },
 * ),
 * 
 **/

class AccountController extends Controller
{   
    private static $MODEL_NAME_UP_FIRST = 'Account';
    private static $MODEL_NAME_LOWER = 'account';
    private static $MODEL_CLASS = Account::class;
    private $MODEL;

    public function __construct()
    {
        $this->MODEL = new self::$MODEL_CLASS();
    }

    public function getAllAccounts(Request $request) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('viewAny', self::$MODEL_CLASS)->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*--------------------------------GET-QUERY-STRING---------------------------------*/

        $limit = $request->query('limit') ? (int) $request->query('limit') : 5;

        /*--------------------------------FILTERING/SORTING--------------------------------*/

        $model = $this->MODEL->select('*');

        SortFilter::sortFilter($request, $model);

        /*---------------------------------PAGINATE-RESULT---------------------------------*/
        
        try {
    
            // paginate data
            $model = $model->paginate($limit)->toArray();

        } catch (\Exception $e) {

            $response = ResponseJson::format([], 'Error while getting the ' . self::$MODEL_NAME_LOWER . 's');

            return response()->json($response, 500);
        }

        $response = ResponseJson::format($model, '');

        return response()->json($response, 200);
    }

    public function getAccount($accountId, Request $request) {

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($accountId);

        if (!$model) {

            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('viewSingle', [self::$MODEL_CLASS, $accountId])->allowed();
        
        if (!$auth) {
            
            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*--------------------------------POSITIVE-RESPONSE--------------------------------*/

        $response = ResponseJson::format($model, ''); 
        return response()->json($response, 200);
    }

    public function getAccountInfo($accountId, Request $request) {

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($accountId);

        if (!$model) {

            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('viewSingleDetails', [self::$MODEL_CLASS, $accountId])->allowed();
        
        if (!$auth) {
            
            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        $model = $model->select('name', 'surname')->where('id', $accountId)->get()->toArray()[0];

        /*--------------------------------POSITIVE-RESPONSE--------------------------------*/

        $response = ResponseJson::format($model, ''); 
        return response()->json($response, 200);
    }

    public function createAccount(Request $request){

        /*----------------------------------AUTHORIZATION----------------------------------*/


        $auth = Gate::inspect('create', self::$MODEL_CLASS)->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*------------------------------------FUNCTION-------------------------------------*/

        $rules = [
            'username' => 'required|string|min:5|max:255|unique:accounts',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:accounts',
            'surname' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];

        $validationMsgs = Translations::getValidations(self::$MODEL_CLASS);

        $validations = ApiFunctions::validateCreation($request, $rules, $validationMsgs);

        if (count($validations['data']) === 0) {

            $result = ResponseJson::format([], $validations['message']);
            return response()->json($result, 400);
        }

        $data = $validations['data'];

        if (count($data) === 0) {

            $result = ResponseJson::format([], $data['message']);
            return response()->json($result, 400);
        }


        /*-------------------------------CREATE-NEW-ACCOUNT--------------------------------*/

        $current = Auth::user();

        $modelObj = [
            'username' => $data['username'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'author' => $current->username,
        ];


        try{
            $created = $this->MODEL->create($modelObj);
            $lastId = [
                'id' => $created->id
            ];

            if (!$created) {
                $result = ResponseJson::format([], 'Insert unsuccess');
                return response()->json($result, 500);
            }

        } catch (\Exception $e){

            $msg = 'Error while creating new ' . self::$MODEL_NAME_LOWER;

            $result = ResponseJson::format([], $msg);
            return response()->json($result, 500);
        }

        /*-------------------------------CREATE-NEW-ACCOUNT--------------------------------*/

        $result = ResponseJson::format($lastId, self::$MODEL_NAME_UP_FIRST . ' created successfully');
        return response()->json($result, 201);
    }

    public function updateAccount($accountId, Request $request){

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('update', [self::$MODEL_CLASS, $accountId])->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($accountId);

        if (!$model) {

            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
        }
        
        $currentModelData = $model->where('id', $accountId)->get()->toArray()[0];

        /*--------------------------------VALIDATE-USERNAME--------------------------------*/


        if ($currentModelData['username'] === $request['username']){
            unset($request['username']);
        }

        /*---------------------------------VALIDATE-EMAIL----------------------------------*/

        if ($currentModelData['email'] === $request['email']){
            unset($request['email']);
        }

        /*---------------------------------DATA-VALIDATION---------------------------------*/

        // Filter the inserted data

        $rules = [
            'username' => 'string|min:5|max:255|unique:accounts',
            'name' => 'string|max:255',
            'surname' => 'string|max:255',
            'email' => 'email|max:255|unique:accounts',
            'password' => 'string|min:6',
        ];
        
        $validationMsgs = Translations::getValidations(self::$MODEL_CLASS);

        $validations = ApiFunctions::validateUpdate($request, $rules, false, $validationMsgs);

        /*-------------------------------CHECK-VALIDATION----------------------------------*/
        

        if (count($validations['data']) === 0) {

            $result = ResponseJson::format([], $validations['message']);
            return response()->json($result, 400);
        }

        $data = $validations['data'];

        if (count($data) === 0) {

            $result = ResponseJson::format([], $data['message']);
            return response()->json($result, 400);
        }

        /*---------------------------------HASH-PASSWORD-----------------------------------*/

        /// hashing password if exists "password" field

        if (isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }

        /*---------------------------------INSERT-AUTHOR-----------------------------------*/

        // Update author 

        $current = Auth::user();

        $data['author'] = $current->username;

        /*---------------------------------STORE-DATA-IN-DB--------------------------------*/

        try{
            //Update account
            $model->update($data);

        } catch (\Exception $e) {
            $response = ResponseJson::format([], 'Update unsuccess');
            return response()->json($response, 500);
        }

        /*---------------------------------POSITIVE-RESPONSE-------------------------------*/

        $response = ResponseJson::format([], 'Update Success');
        return response()->json($response, 200);
    }

    public function deleteAccount($accountId, Request $request){

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($accountId);

        if (!$model) {

            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('delete', [self::$MODEL_CLASS, $accountId])->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*-----------------------SUPER-CANNOT-DELETE-HIS-OWN-ACCOUNT-----------------------*/

        $cannotDeleteAccount = $model['id'] === Auth::user()['id'];

        if ($cannotDeleteAccount) {
            $result = ResponseJson::format([], 'Delete unsuccess');
            return response()->json($result, 500);
        }
        
        /*-------------------------------DELETE-VENUE-IN-DB--------------------------------*/

        $deleted = $model->forceDelete();

        if (!$deleted) {

            $result = ResponseJson::format([], 'Delete unsuccess');
            return response()->json($result, 500);
        }

        $result = ResponseJson::format([], 'Delete success');
        return response()->json($result, 200);
    }

    /*--------------------------------PRIVATE-FUNCTIONS--------------------------------*/

}