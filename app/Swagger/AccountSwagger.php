<?php

namespace App\Swagger;

/**
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
 *                type="array", 
 *                @OA\Items(
 *                  ref="#/components/schemas/AccountsResponse"
 *                )
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
 *     path="/api/accounts/username/all",
 *     summary="Get all accounts usernames",
 *     operationId="getAllUsernames",
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
 *                type="array", 
 *                @OA\Items(
 *                  ref="#/components/schemas/AccountsUsernames"
 *                )
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
 *  @OA\Schema(
 *   schema="AccountsUsernames",
 *   type="object",
 *   properties={
 *     @OA\Property(
 *         property="id", 
 *         type="string", 
 *         example="a6ff9885-6166-4375-979a-bad6e2b4b9be", 
 *     ), 
 *     @OA\Property(
 *         property="username", 
 *         type="string", 
 *         example="luca10", 
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
 */

class AccountSwagger
{
    public function __construct()
    {
        //
    }
}
