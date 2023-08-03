<?php declare(strict_types=1);

namespace App\Services\User\Read;

use App\Repositories\User\PdoUserRepository;

class ReadUserService
{
    public function execute(ReadUserRequest $request): ReadUserResponse
    {
        $response = (new PdoUserRepository())->read($request->email());

        return new ReadUserResponse($response);
    }
}