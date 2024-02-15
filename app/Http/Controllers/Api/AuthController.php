<?php

namespace App\Http\Controllers\Api;

use App\DTO\Auth\GetUserTokenResponseDTO;
use App\Http\Controllers\Controller;
use App\Services\ApplicationServices\User\GetUserTokenService;
use App\Values\Auth\GetUserTokenRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getUserToken(Request $request, GetUserTokenService $getUserTokenService): JsonResponse
    {
        $getUserTokenRequest = GetUserTokenRequest::validateAndCreate($request);

        $userToken = $getUserTokenService->execute($getUserTokenRequest);

        $getUserTokenResponseDTO = new GetUserTokenResponseDTO($userToken);

        return response()->json($getUserTokenResponseDTO);
    }
}
