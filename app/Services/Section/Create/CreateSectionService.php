<?php declare(strict_types=1);

namespace App\Services\Section\Create;

use App\Repositories\Section\PdoSectionRepository;

class CreateSectionService
{
    public function execute(CreateSectionRequest $request): CreateSectionResonse
    {
        $status = (new PdoSectionRepository())->create($request);

        return (new CreateSectionResonse($status));
    }
}