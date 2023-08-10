<?php declare(strict_types=1);

namespace App\Services\User\Update;

use App\Repositories\User\PdoUserRepository;

class UpdateUserService
{
    public function execute(UpdateUserRequest $request): void
    {
        (new PdoUserRepository())->updateInfo($request);
    }
}
