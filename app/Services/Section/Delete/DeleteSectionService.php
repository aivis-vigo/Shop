<?php declare(strict_types=1);

namespace App\Services\Section\Delete;

use App\Repositories\Section\PdoSectionRepository;

class DeleteSectionService
{
    public function execute(DeleteSectionRequest $request): DeleteSectionResponse
    {
        $status = (new PdoSectionRepository())->delete($request);

        return new DeleteSectionResponse($status);
    }

    public function disableDelete(): array
    {
        return (new PdoSectionRepository())->disableDelete();
    }
}