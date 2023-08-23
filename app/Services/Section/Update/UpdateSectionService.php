<?php declare(strict_types=1);

namespace App\Services\Section\Update;

use App\Repositories\Section\PdoSectionRepository;

class UpdateSectionService
{
    public function execute(UpdateSectionRequest $section): UpdateSectionResponse
    {
        $response = (new PdoSectionRepository())->update($section);

        return new UpdateSectionResponse($response);
    }
}