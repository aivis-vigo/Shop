<?php declare(strict_types=1);

namespace App\Services\User\Password;

use App\Repositories\User\PdoUserRepository;

class UpdatePasswordService
{
    public function execute(UpdatePasswordRequest $request): void
    {
        (new PdoUserRepository())->validatePassword($request);
    }
}