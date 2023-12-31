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

    public function fetchAll(): ReadOptionResponse
    {
        $options = (new PdoOptionRepository())->fetchAll();

        return new ReadOptionResponse($options);
    }

    public function edit(ReadOptionsRequest $request): ReadOptionResponse
    {
        $options = (new PdoOptionRepository())->edit($request);

        return new ReadOptionResponse($options);
    }
}