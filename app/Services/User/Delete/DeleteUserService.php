<?php declare(strict_types=1);

namespace App\Services\User\Delete;

use App\Repositories\User\PdoUserRepository;

class DeleteUserService
{
    public function execute(DeleteUserRequest $user): void
    {
        (new PdoUserRepository())->delete($user);
    }
}