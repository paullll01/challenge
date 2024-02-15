<?php

namespace App\Services\ApplicationServices\User;

use App\Services\User\IUserService;
use App\Values\Auth\GetUserTokenRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetUserTokenService
{
    public function __construct(
        private IUserService $iUserService
    ) {
    }

    public function execute(GetUserTokenRequest $getUserTokenRequest): string
    {
        $user = $this->iUserService->getUserByEmail($getUserTokenRequest->getEmail());

        if (null === $user) {
            throw new NotFoundHttpException("User not found");
        }

        $this->iUserService->checkPasswordMatches($user, $getUserTokenRequest->getPassword());

        return $user->createToken($getUserTokenRequest->getDeviceName())->plainTextToken;
    }
}
