<?php declare(strict_types=1);

namespace App\Services\User\Create;

use App\Models\User;
use App\Repositories\User\PdoUserRepository;

class CreateUserService
{
    public function execute(CreateUserRequest $request): void
    {
        $user = new User(
            $request->firstName(),
            $request->lastName(),
            $request->email(),
            $request->password()
        );

        (new PdoUserRepository())->create($user);
    }
}