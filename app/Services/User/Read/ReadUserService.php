<?php declare(strict_types=1);

namespace App\Services\User\Read;

use App\Repositories\User\PdoUserRepository;

class ReadUserService
{
    public function execute(): ReadUserResponse
    {
        $response = (new PdoUserRepository())->read();

        return new ReadUserResponse($response);
    }
}