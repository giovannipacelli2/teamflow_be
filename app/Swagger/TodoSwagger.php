<?php

namespace App\Swagger;

/**
 * 
 * @OA\Get(
 *     path="/api/todo/all",
 *     summary="Get all todos data",
 *     operationId="getAllTodos",
 *     tags={"todo"},
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
 *             example="created_at"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="sortValue",
 *         in="query",
 *         description="sorting type",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example="descend"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="filterBy",
 *         in="query",
 *         description="fields to filter",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example=""
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="filterValue",
 *         in="query",
 *         description="Values to filter",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example=""
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="start",
 *         in="query",
 *         description="filter by date: start data",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example=""
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="end",
 *         in="query",
 *         description="filter by date: end data",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example=""
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
 *                ref="#/components/schemas/TodosResponse"
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
 *     path="/api/todo/shared/all",
 *     summary="Get all shared todos",
 *     operationId="getAllSharedTodos",
 *     tags={"todo"},
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
 *             example="created_at"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="sortValue",
 *         in="query",
 *         description="sorting type",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example="descend"
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="filterBy",
 *         in="query",
 *         description="fields to filter",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example=""
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="filterValue",
 *         in="query",
 *         description="Values to filter",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example=""
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="start",
 *         in="query",
 *         description="filter by date: start data",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example=""
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="end",
 *         in="query",
 *         description="filter by date: end data",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example=""
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
 *                ref="#/components/schemas/TodosResponse"
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
 *     path="/api/todo/{todoId}/accounts/all",
 *     summary="Get all todo accounts",
 *     description="Get all accounts of a specific todo",
 *     operationId="getAllTodoAccounts",
 *     tags={"todo"},
 *     @OA\Parameter(
 *         name="todoId",
 *         in="path",
 *         description="todo id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="2588e5ad-0c5c-44e7-a865-a196b067c621"
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="data", 
 *                 type="array",
 *                 @OA\Items(
 *                    ref="#/components/schemas/TodoAccountsResponse"
 *                 )
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
 *               example="Todo not found"
 *           ),
 *         )
 *     ),
 *     security={{"bearerAuth":{}}}
 * ),
 * 
 * @OA\Get(
 *     path="/api/todo/{todoId}",
 *     summary="Get data of a single todo",
 *     operationId="getTodo",
 *     tags={"todo"},
 *     @OA\Parameter(
 *         name="todoId",
 *         in="path",
 *         description="todo id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="2588e5ad-0c5c-44e7-a865-a196b067c621"
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
 *                 ref="#/components/schemas/TodoResponse"
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
 *               example="Todo not found"
 *           ),
 *         )
 *     ),
 *     security={{"bearerAuth":{}}}
 * ),
 * 
 * @OA\Post(
 *     path="/api/todo",
 *     summary="Create new todo",
 *     description="",
 *     operationId="createTodo",
 *     tags={"todo"},
 *     @OA\RequestBody(
 *         required=true,
 *         description="JSON with todo data",
 *         @OA\JsonContent(
 *             type="object",
 *             ref="#/components/schemas/TodoBodyReq"
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
 *                   example="45ca2e2c-91d1-482c-85bf-f0fc23022808", 
 *               ), 
 *           ), 
 *           @OA\Property(
 *               property="message", 
 *               type="string", 
 *               example="Insert success", 
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
 *     path="/api/todo/{todoId}",
 *     summary="Update a specific todo",
 *     description="",
 *     operationId="updateTodo",
 *     tags={"todo"},
 *     @OA\Parameter(
 *         name="todoId",
 *         in="path",
 *         description="todo id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="bf0b6373-b772-4bee-bdfa-88bf5ff092f3"
 *         ),
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="JSON with todo data",
 *         @OA\JsonContent(
 *             type="object",
 *             ref="#/components/schemas/TodoBodyReq"
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
 *               example="Todo not found"
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
 *               example="Update unsuccess"
 *           ),
 *         )
 *     ),
 *     security={{"bearerAuth":{}}}
 * ),
 * 
 * @OA\Patch(
 *     path="/api/todo/{todoId}",
 *     summary="Share a specific todo with other accounts",
 *     description="",
 *     operationId="shareTodo",
 *     tags={"todo"},
 *     @OA\Parameter(
 *         name="todoId",
 *         in="path",
 *         description="todo id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="bf0b6373-b772-4bee-bdfa-88bf5ff092f3"
 *         ),
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="JSON with todo data",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="accounts", 
 *                 type="array", 
 *                 @OA\Items(
 *                     type="string", 
 *                     example="40992b3a-3cbd-4d99-80cd-cd351a32324f", 
 *                 ), 
 *             ),
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
 *               example="Todo not found"
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
 *               example="Update unsuccess"
 *           ),
 *         )
 *     ),
 *     security={{"bearerAuth":{}}}
 * ),
 * 
 * @OA\Delete(
 *     path="/api/todo/{todoId}",
 *     summary="Delete an existing todo",
 *     description="",
 *     operationId="deleteTodo",
 *     tags={"todo"},
 *     @OA\Parameter(
 *         name="todoId",
 *         in="path",
 *         description="todo id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="bf0b6373-b772-4bee-bdfa-88bf5ff092f3"
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
 *               example="Todo not found"
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
 * 
 * 
 * 
 * 
 * 
 * @OA\Schema(
 *   schema="TodoResponse",
 *   type="object",
 *   properties={
 *     @OA\Property(
 *         property="id", 
 *         type="string", 
 *         example="1dcc7661-1251-456a-873c-2aa2028de9fd", 
 *     ), 
 *     @OA\Property(
 *         property="title", 
 *         type="string", 
 *         example="Andare in palestra", 
 *     ), 
 *     @OA\Property(
 *         property="description", 
 *         type="string", 
 *         example="Ricorda la cintura", 
 *     ), 
 *     @OA\Property(
 *         property="note", 
 *         type="string", 
 *     ), 
 *     @OA\Property(
 *         property="category", 
 *         type="string", 
 *         example="hobby", 
 *     ), 
 *     @OA\Property(
 *         property="checked", 
 *         type="boolean", 
 *     ), 
 *     @OA\Property(
 *         property="created_at", 
 *         type="string", 
 *         example="2024-10-26 15:40:00", 
 *     ), 
 *     @OA\Property(
 *         property="updated_at", 
 *         type="string", 
 *         example="2024-10-26 15:40:00", 
 *     ), 
 *     @OA\Property(
 *         property="account_id", 
 *         type="string", 
 *         example="8a587029-80a2-4ae9-82e6-4f69f7383e63", 
 *     ),
 *     @OA\Property(
 *         property="sharedWith", 
 *         type="array", 
 *         @OA\Items(
 *             type="object", 
 *             @OA\Property(
 *                 property="id", 
 *                 type="string", 
 *                 example="2d414d58-79d9-4b90-897f-d29889e86b98", 
 *             ), 
 *             @OA\Property(
 *                 property="username", 
 *                 type="string", 
 *                 example="account_test", 
 *             ), 
 *         ), 
 *     ), 
 *     @OA\Property(
 *         property="isShared", 
 *         type="boolean", 
 *     ),
 *   },
 * ),
 * 
 * @OA\Schema(
 *   schema="TodoAccountsResponse",
 *   type="object",
 *   properties={
 *     @OA\Property(
 *         property="id", 
 *         type="string", 
 *         example="1dcc7661-1251-456a-873c-2aa2028de9fd", 
 *     ), 
 *     @OA\Property(
 *         property="username", 
 *         type="string", 
 *         example="user_00", 
 *     ), 
 *   },
 * ),
 * 
 * @OA\Schema(
 *   schema="TodosResponse",
 *   type="object",
 *   properties={
 *      @OA\Property(
 *          property="current_page", 
 *          type="number", 
 *          example=1,
 *      ), 
 *      @OA\Property(
 *          property="data", 
 *          type="array", 
 *          @OA\Items(
 *              type="object", 
 *              ref="#/components/schemas/TodoResponse"
 *          ), 
 *      ), 
 *      @OA\Property(
 *          property="first_page_url", 
 *          type="string", 
 *          example="http://localhost:8000/api/todo/all?page=1", 
 *      ), 
 *      @OA\Property(
 *          property="from", 
 *          type="number", 
 *          example=1,
 *      ), 
 *      @OA\Property(
 *          property="last_page", 
 *          type="number", 
 *          example=1,
 *      ), 
 *      @OA\Property(
 *          property="last_page_url", 
 *          type="string", 
 *          example="http://localhost:8000/api/todo/all?page=1", 
 *      ), 
 *      @OA\Property(
 *          property="links", 
 *          type="array", 
 *          @OA\Items(
 *              type="object", 
 *              @OA\Property(
 *                  property="url", 
 *                  format="nullable", 
 *                  type="string", 
 *              ), 
 *              @OA\Property(
 *                  property="label", 
 *                  type="string", 
 *                  example="pagination.previous", 
 *              ), 
 *              @OA\Property(
 *                  property="active", 
 *                  type="boolean", 
 *              ), 
 *          ), 
 *      ), 
 *      @OA\Property(
 *          property="next_page_url", 
 *          format="nullable", 
 *          type="string", 
 *      ), 
 *      @OA\Property(
 *          property="path", 
 *          type="string", 
 *          example="http://localhost:8000/api/todo/all", 
 *      ), 
 *      @OA\Property(
 *          property="per_page", 
 *          type="number", 
 *          example=10,
 *      ), 
 *      @OA\Property(
 *          property="prev_page_url", 
 *          format="nullable", 
 *          type="string", 
 *      ), 
 *      @OA\Property(
 *          property="to", 
 *          type="number", 
 *          example=1,
 *      ), 
 *      @OA\Property(
 *          property="total", 
 *          type="number", 
 *          example=1,
 *      ),
 *   }),
 * ),
 * 
 * @OA\Schema(
 *   schema="TodoBodyReq",
 *   type="object",
 *   properties={
 *     @OA\Property(
 *         property="title", 
 *         type="string", 
 *         example="Todo di prova", 
 *     ), 
 *     @OA\Property(
 *         property="description", 
 *         type="string", 
 *         example="descrizione di prova", 
 *     ), 
 *     @OA\Property(
 *         property="note", 
 *         type="string", 
 *         example="nessuna nota", 
 *     ), 
 *     @OA\Property(
 *         property="category", 
 *         type="string", 
 *         example="importanti", 
 *     ), 
 *     @OA\Property(
 *         property="checked", 
 *         type="boolean", 
 *     ),
 * }),
 *  
 * )
 */

class TodoSwagger
{
    public function __construct()
    {
        //
    }
}
