<?php

namespace App\Swagger;

/**
 *
 *  @OA\Info(
 *      title="S2I final", 
 *      version="0.8",
 *  ),
 *  
 *  @OA\Server(
 *     url="http://192.168.169.128:8000",
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
 */

class AAAConfig
{
    public function __construct()
    {
        //
    }
}
