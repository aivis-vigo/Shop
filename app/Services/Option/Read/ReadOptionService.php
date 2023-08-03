<?php declare(strict_types=1);

namespace App\Services\Option\Read;

use App\Repositories\Option\PdoOptionRepository;

class ReadOptionService
{
    public function execute(): ReadOptionResponse
    {
        $options = (new PdoOptionRepository())->read();

        return new ReadOptionResponse($options);
    }
}