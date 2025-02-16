<?php

namespace App\Swagger;

/**
 * 
 * @OA\Get(
 *     path="/api/todo/{todoId}/comment/all",
 *     summary="Get comments from specific todo",
 *     operationId="getAllTodoComments",
 *     tags={"comment"},
 *     @OA\Parameter(
 *         name="todoId",
 *         in="path",
 *         description="todo id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="e14b3225-b510-47f1-bed4-bb227696098e"
 *         ),
 *     ),
 *     
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
 *             example=""
 *         ),
 *     ),
 *     @OA\Parameter(
 *         name="sortValue",
 *         in="query",
 *         description="sorting type",
 *         required=false,
 *         @OA\Schema(
 *             type="string",
 *             example=""
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
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             type="object",
 *             ref="#/components/schemas/CommentsResponse"
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
 *     path="/api/comment/{commentId}",
 *     summary="Get data of a single comment",
 *     operationId="getComment",
 *     tags={"comment"},
 *     @OA\Parameter(
 *         name="commentId",
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
 *                 ref="#/components/schemas/CommentResponse"
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
 *               example="Not found"
 *           ),
 *         )
 *     ),
 *     security={{"bearerAuth":{}}}
 * ),
 * 
 * @OA\Post(
 *     path="/api/todo/{todoId}/comment",
 *     summary="Create new comment in a specific todo",
 *     description="",
 *     operationId="createComment",
 *     tags={"comment"},
 *     @OA\Parameter(
 *         name="todoId",
 *         in="path",
 *         description="todo id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="e14b3225-b510-47f1-bed4-bb227696098e"
 *         ),
 *     ),
 *     
 *     @OA\RequestBody(
 *         required=true,
 *         description="JSON with comment data",
 *         @OA\JsonContent(
 *             type="object",
 *             ref="#/components/schemas/CommentBodyReq"
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
 *     path="/api/comment/{commentId}",
 *     summary="Update a specific comment",
 *     description="",
 *     operationId="updateComment",
 *     tags={"comment"},
 *     @OA\Parameter(
 *         name="commentId",
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
 *         description="JSON with comment data",
 *         @OA\JsonContent(
 *             type="object",
 *             ref="#/components/schemas/CommentBodyReq"
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
 *               example="Not found"
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
 *     path="/api/comment/{commentId}",
 *     summary="Delete an existing comment",
 *     description="",
 *     operationId="deleteComment",
 *     tags={"comment"},
 *     @OA\Parameter(
 *         name="commentId",
 *         in="path",
 *         description="comment id",
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
 *               example="Not found"
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
 * @OA\Schema(
 *   schema="CommentResponse",
 *   type="object",
 *   properties={
 *     @OA\Property(
 *         property="id", 
 *         type="string", 
 *         example="6ca498b0-3fb6-4094-ba16-42728383c587", 
 *     ), 
 *     @OA\Property(
 *         property="content", 
 *         type="string", 
 *         example="Commento numero uno", 
 *     ), 
 *     @OA\Property(
 *         property="created_at", 
 *         type="string", 
 *         example="2025-01-18 16:14:44", 
 *     ), 
 *     @OA\Property(
 *         property="updated_at", 
 *         type="string", 
 *         example="2025-01-18 16:14:45", 
 *     ), 
 *     @OA\Property(
 *         property="todo_id", 
 *         type="string", 
 *         example="1dcc7661-1251-456a-873c-2aa2028de9fd", 
 *     ), 
 *     @OA\Property(
 *         property="account_id", 
 *         type="string", 
 *         example="8a587029-80a2-4ae9-82e6-4f69f7383e63", 
 *     ), 
 *     @OA\Property(
 *         property="account_username", 
 *         type="string", 
 *         example="test", 
 *     ),
 *   },
 * ),
 * 
 * @OA\Schema(
 *   schema="CommentsResponse",
 *   type="object",
 *   properties={
 *      @OA\Property(
 *          property="data", 
 *          type="object", 
 *          @OA\Property(
 *              property="current_page", 
 *              type="number", 
 *              example=1,
 *          ), 
 *          @OA\Property(
 *              property="data", 
 *              type="array", 
 *              @OA\Items(
 *                  type="object",
 *                  ref="#/components/schemas/CommentResponse"
 *              ), 
 *          ), 
 *          @OA\Property(
 *              property="first_page_url", 
 *              type="string", 
 *              example="http://host/request/all?page=1", 
 *          ), 
 *          @OA\Property(
 *              property="from", 
 *              type="number", 
 *              example=1,
 *          ), 
 *          @OA\Property(
 *              property="last_page", 
 *              type="number", 
 *              example=1,
 *          ), 
 *          @OA\Property(
 *              property="last_page_url", 
 *              type="string", 
 *              example="http://host/request/all?page=1", 
 *          ), 
 *          @OA\Property(
 *              property="links", 
 *              type="array", 
 *              @OA\Items(
 *                  type="object", 
 *                  @OA\Property(
 *                      property="url", 
 *                      format="nullable", 
 *                      type="string", 
 *                  ), 
 *                  @OA\Property(
 *                      property="label", 
 *                      type="string", 
 *                      example="pagination.previous", 
 *                  ), 
 *                  @OA\Property(
 *                      property="active", 
 *                      type="boolean", 
 *                  ), 
 *              ), 
 *          ), 
 *          @OA\Property(
 *              property="next_page_url", 
 *              format="nullable", 
 *              type="string", 
 *          ), 
 *          @OA\Property(
 *              property="path", 
 *              type="string", 
 *              example="http://host/request/all", 
 *          ), 
 *          @OA\Property(
 *              property="per_page", 
 *              type="number", 
 *              example=10,
 *          ), 
 *          @OA\Property(
 *              property="prev_page_url", 
 *              format="nullable", 
 *              type="string", 
 *          ), 
 *          @OA\Property(
 *              property="to", 
 *              type="number", 
 *              example=1,
 *          ), 
 *          @OA\Property(
 *              property="total", 
 *              type="number", 
 *              example=1,
 *          ),
 *      ),    
 *      @OA\Property(
 *        property="message", 
 *        type="string", 
 *      ),
 *   }),
 * ),
 * 
 * @OA\Schema(
 *   schema="CommentBodyReq",
 *   type="object",
 *   properties={
 *     @OA\Property(
 *         property="content", 
 *         type="string", 
 *         example="Commento di prova", 
 *     ),
 * }),
 * 
 * 
 */

class CommentSwagger
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
}
