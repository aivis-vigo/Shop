<?php declare(strict_types=1);

namespace App\Services\Option\Read;

use App\Repositories\Option\PdoOptionRepository;

class ReadOptionService
{
    public function execute(ReadOptionsRequest $request): ReadOptionResponse
    {
        $options = (new PdoOptionRepository())->read($request->id());

        return new ReadOptionResponse($options);
    }
}