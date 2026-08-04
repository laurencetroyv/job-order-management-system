<?php

namespace Modules\Authentication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Modules\Authentication\Data\SignInData;
use Modules\Authentication\Http\Requests\SignInRequest;
use Modules\Authentication\Services\AuthenticationService;

class AuthenticationController extends Controller
{
    public function __construct(
        private readonly AuthenticationService $authenticationService,
    ) {}

    public function signIn(SignInRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $data = SignInData::from($validated);

        $response = $this->authenticationService->createApiToken($data, $request->userAgent());

        return response()->json([
            'token' => $response['token'],
            'user'  => $response['user'],
        ]);
    }

    public function signOut(Request $request): JsonResponse
    {
        $this->authenticationService->revokeToken($request->user());

        return response()->json([
            'message' => 'Successfully logged out.',
        ]);
    }
}
