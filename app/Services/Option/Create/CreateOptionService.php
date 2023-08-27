<?php declare(strict_types=1);

namespace App\Services\Option\Create;

use App\Repositories\Option\PdoOptionRepository;

class CreateOptionService
{
    public function execute(CreateOptionRequest $option): CreateOptionResponse
    {
        $status = (new PdoOptionRepository())->create($option);

        return new CreateOptionResponse($status);
    }
}