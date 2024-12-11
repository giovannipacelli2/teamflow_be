<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Todo;
use App\Models\Account;

// Custom static class
use App\Include\ApiFunctions;
use App\Include\SortFilter;
use App\Rules\accountValidation;
use App\Rules\TodoValidation;
use App\Translations\Translations;

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

class TodoController extends Controller
{
    private static $MODEL_NAME_UP_FIRST = 'Todo';
    private static $MODEL_NAME_LOWER = 'todo';
    private static $MODEL_CLASS = Todo::class;
    private $MODEL;

    public function __construct()
    {
        $this->MODEL = new self::$MODEL_CLASS();
    }

    public function getAllTodos(Request $request) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $viewAll = Gate::inspect('viewAny', self::$MODEL_CLASS)->allowed();

        $currentAccount = Auth::user();

        if (!$currentAccount) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*--------------------------------GET-QUERY-STRING---------------------------------*/

        $limit = $request->query('limit') ? (int) $request->query('limit') : 5;

        /*-----------------------ELEMENTS-FROM-ACCOUNT-PERMISSIONS-------------------------*/

        $model = null;

        if ($viewAll) {

            $model = $this->MODEL->select('*');
        } else {
            
            $model = $this->MODEL->where('account_id', $currentAccount->id);
        }


        /*--------------------------------FILTERING/SORTING--------------------------------*/


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

    public function getAllTodoAccounts(Request $request, $modelId) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('viewAny', self::$MODEL_CLASS)->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*---------------------------------DATA-VALIDATION---------------------------------*/

        // Filter the inserted data

        $req = [
            'todoId' => $modelId,
        ];
        $rules = [
            'todoId' => ['required', 'string', new TodoValidation],
        ];

        $validationMsgs = Translations::getValidations(self::$MODEL_CLASS);
        $validator = validator($req, $rules, $validationMsgs);

        if ($validator->fails()) {
            return ResponseJson::response([], 400, $validator->errors());
        }

        /*------------------------------------GET-MODEL------------------------------------*/

        $model = $this->MODEL->find($modelId);

        /*---------------------------------PAGINATE-RESULT---------------------------------*/
        
        try {
    
            // get todo accounts
            $accounts = $model->sharedWith()->get()->select(['id', 'username']);

        } catch (\Exception $e) {

            $response = ResponseJson::format([], 'Error while getting the ' . self::$MODEL_NAME_LOWER . 's');

            return response()->json($response, 500);
        }

        $response = ResponseJson::format($accounts, '');

        return response()->json($response, 200);
    }

    public function getAllSharedTodos(Request $request) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $viewAll = Gate::inspect('viewShared', self::$MODEL_CLASS)->allowed();

        $currentAccount = Auth::user();

        if (!$currentAccount && !$viewAll) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*--------------------------------GET-QUERY-STRING---------------------------------*/

        $limit = $request->query('limit') ? (int) $request->query('limit') : 5;

        /*-----------------------ELEMENTS-FROM-ACCOUNT-PERMISSIONS-------------------------*/

        $currentAccount = Account::find(Auth::user()->id);

        $model = $currentAccount->sharedWithMe();

        /*--------------------------------FILTERING/SORTING--------------------------------*/


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

    public function getTodo($modelId, Request $request) {

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($modelId);

        if (!$model) {

            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
        }

        $model = $this->MODEL->where('id', $modelId);

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('viewSingle', [self::$MODEL_CLASS, $model])->allowed();
        
        if (!$auth) {
            
            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*--------------------------------POSITIVE-RESPONSE--------------------------------*/

        $model = $model->get()->toArray()[0];
        $response = ResponseJson::format($model, ''); 
        return response()->json($response, 200);
    }

    public function createTodo(Request $request){

        /*----------------------------------AUTHORIZATION----------------------------------*/


        $auth = Gate::inspect('create', self::$MODEL_CLASS)->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*------------------------------------FUNCTION-------------------------------------*/

        $rules = [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'category' => 'nullable|string',
            'checked' => 'nullable|boolean',
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


        /*--------------------------------CREATE-NEW-MODEL---------------------------------*/

        $modelObj = ApiFunctions::arrCamelToSnake($data);

        // add account id
        $currentAccountId = Auth::user()->id;
        $modelObj['account_id'] = $currentAccountId;

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

    public function updateTodo($todoId, Request $request){

        /*-----------------------------------FIND-MODEL------------------------------------*/

        $checkModel = $this->MODEL->find($todoId);

        if (!$checkModel) {
        
            $result = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($result, 404);
        }

        $model = $this->MODEL->where('id', $todoId);

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('update', [self::$MODEL_CLASS, $model])->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*---------------------------------DATA-VALIDATION---------------------------------*/

        // Filter the inserted data

        $rules = [
            'title' => 'string',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'category' => 'nullable|string',
            'checked' => 'nullable|boolean',
        ];

        $validationMsgs = Translations::getValidations(self::$MODEL_CLASS);

        $validations = ApiFunctions::validateUpdate($request, $rules, true, $validationMsgs);

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

        /*----------------------------CREATE-ELOQUENT-PATIENT-MODEL------------------------*/

        $modelObj = ApiFunctions::arrCamelToSnake($data);

        /*---------------------------------STORE-DATA-IN-DB--------------------------------*/

        try{
            //Update account
            $model->update($modelObj);

        } catch (\Exception $e) {
            $response = ResponseJson::format([], 'Update unsuccess');
            return response()->json($response, 500);
        }
        $response = ResponseJson::format([], 'Update success');
        return response()->json($response, 200);
    }

    public function shareTodo($todoId, Request $request){

        /*-----------------------------------FIND-MODEL------------------------------------*/

        $checkModel = $this->MODEL->find($todoId);

        if (!$checkModel) {
        
            $result = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($result, 404);
        }

        $model = $this->MODEL->where('id', $todoId);

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('share', [self::$MODEL_CLASS, $model])->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*---------------------------------DATA-VALIDATION---------------------------------*/

        // Filter the inserted data

        $rules = [
            'accounts' => 'nullable|array',
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

        /*-----------------------------------CHECK-ACCOUNTS--------------------------------*/
        
        $accountRules = [];
        $accountIds = [];

        foreach($data['accounts'] as $i=>$account){

            $field = 'account_' . $i;

            $accountIds = [
                ...$accountIds,
                $field => $account
            ];

           $accountRules = [
                ...$accountRules,
                $field => [new accountValidation]
           ];

        }

        $validator = validator($accountIds, $accountRules);

        if ($validator->fails()) {

            $errors = $validator->errors();

            $result = ResponseJson::format([], $errors);
            return response()->json($result, 400);
        }

        /*---------------------------------STORE-DATA-IN-DB--------------------------------*/

        try{
            //update pivot
            $this->MODEL->find($todoId)->sharedWith()->sync($data['accounts']);

        } catch (\Exception $e) {
            $response = ResponseJson::format([], 'Update unsuccess');
            return response()->json($response, 500);
        }
        $response = ResponseJson::format([], 'Update success');
        return response()->json($response, 200);
    }

    public function deleteTodo($todoId){

        /*-----------------------------CHECK-IF-PATIENT-EXISTS-----------------------------*/

        $checkModel = $this->MODEL::find($todoId);
        
        if (!$checkModel) {
            
            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
        }

        $model = $checkModel->where('id', $todoId);

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('delete', [self::$MODEL_CLASS, $model])->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }    

        /*-------------------------------DELETE-CHECK-IN-DB--------------------------------*/

        $delete = $model->forceDelete();

        if (!$delete) {

            $result = ResponseJson::format([], 'Delete unsuccess');
            return response()->json($result, 500);
        }

        $result = ResponseJson::format([], 'Delete success');
        return response()->json($result, 200);
    }
}
