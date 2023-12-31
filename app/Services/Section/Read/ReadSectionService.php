<?php declare(strict_types=1);

namespace App\Services\Section\Read;

use App\Repositories\Section\PdoSectionRepository;

class ReadSectionService
{
    public function execute(): ReadSectionResponse
    {
        $sections = (new PdoSectionRepository())->read();

        return new ReadSectionResponse($sections);
    }

    public function executeWithoutOptions(): ReadSectionResponse
    {
        $sections = (new PdoSectionRepository())->withoutOptions();

        return new ReadSectionResponse($sections);
    }
}