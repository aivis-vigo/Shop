<?php declare(strict_types=1);

namespace App\Services\User\Create;

use App\Repositories\User\PdoUserRepository;

class CreateUserService
{
    public function execute(CreateUserRequest $request): void
    {
        (new PdoUserRepository())->validate($request->userInfo());
    }
}