<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *    title="Swagger API",
 *    version="1.0.0",
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     securityScheme="sanctum",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 * @OA\Header(
 *   header="Accept",
 *   description="Accept header",
 *   @OA\Schema(type="string", default="application/json")
 *)
 */

abstract class Controller
{
    //
}
