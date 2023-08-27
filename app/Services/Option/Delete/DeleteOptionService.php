<?php declare(strict_types=1);

namespace App\Services\Option\Delete;

use App\Repositories\Option\PdoOptionRepository;

class DeleteOptionService
{
    public function execute(DeleteOptionRequest $option): DeleteOptionResponse
    {
        $status = (new PdoOptionRepository())->delete($option);

        return new DeleteOptionResponse($status);
    }
}