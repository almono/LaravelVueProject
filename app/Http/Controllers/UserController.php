<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get all users",
     *     description="Returns a list of users (requires Sanctum token).",
     *     operationId="getUsers",
     *     tags={"Users"},
     *     security={{"sanctum":{}}}, 
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(type="array", @OA\Items(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com")
     *         ))
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No users found"
     *     )
     * )
    */

    public function index() : JsonResponse
    {
        $usersList = $this->userService->getAllUsers();

        return response()->json([
            $usersList
        ], empty($usersList) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
