<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    /**
    * @OA\Post(
    *     path="/api/auth/login",
    *     summary="Login",
    *     tags={"Auth"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\MediaType(
    *             mediaType="multipart/form-data",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="email",
    *                     type="string",
    *                     description="User Email",
    *                     example="test@test.test",
    *                     default="test@test.test"
    *                 ),
    *                 @OA\Property(
    *                     property="password",
    *                     type="string",
    *                     description="User Password",
    *                     example="test",
    *                     default="test"
    *                 )
    *             )
    *         )
    *     ),
    *     @OA\Response(response="200", description="User logged in successfully"),
    *     @OA\Response(response="400", description="Validation failed"),
    *     @OA\Response(response="401", description="User authorization failed")
    * )
    */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if(!Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ])) {
            return response()->json([
                'message' => 'Incorrect user details provided'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();
        $token = $this->userService->createUserToken($user);

        return response()->json([
            'accessToken' => $token,
            'token_type' => 'Bearer',
        ], Response::HTTP_OK);
    }

    /**
    * @OA\Post(
    *     path="/api/auth/register",
    *     summary="Register",
    *     tags={"Auth"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\MediaType(
    *             mediaType="multipart/form-data",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="name",
    *                     type="string",
    *                     description="User Name",
    *                     example="test123",
    *                     default="test123"
    *                 ),
    *                 @OA\Property(
    *                     property="email",
    *                     type="email",
    *                     description="User Email",
    *                     example="test@test.test",
    *                     default="test@test.test"
    *                 ),
    *                 @OA\Property(
    *                     property="password",
    *                     type="string",
    *                     description="User Password",
    *                     example="test_pass",
    *                     default="test_pass"
    *                 ),
    *                 @OA\Property(
    *                     property="c_password",
    *                     type="string",
    *                     description="Password Confirmation",
    *                     example="test_pass",
    *                     default="test_pass"
    *                 )
    *             )
    *         )
    *     ),
    *     @OA\Response(response="200", description="User registered successfully"),
    *     @OA\Response(response="400", description="Validation failed"),
    *     @OA\Response(response="204", description="User registration failed")
    * )
    */
    public function register(UserRegisterRequest $request)
    {
        $validated = $request->validated();
        $user = $this->userService->registerUser($validated);

        if($user) {
            $token = $this->userService->createUserToken($user);
            event(new UserRegistered($user)); // Dispatch event

            return response()->json([
                'message' => 'Successfully created user!',
                'accessToken'=> $token,
            ], 201);
        } else {
            return response()->json([
                'error'=>'Provide proper details'
            ], Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Get the authenticated User
    *
    * @return [json] user object
    */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Logout the authenticated user",
     *     description="Revokes the user's current access token.",
     *     tags={"Auth"},
     *     security={{ "sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully logged out",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Logged out successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized - Invalid token",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function logout(Request $request)
    {
        $request?->user()?->tokens()?->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ], Response::HTTP_OK);

    }
}