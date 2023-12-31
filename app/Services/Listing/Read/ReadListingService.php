<?php declare(strict_types=1);

namespace App\Services\Listing\Read;

use App\Repositories\Listing\PdoListingRepository;

class ReadListingService
{
    public function execute(ReadListingRequest $request): ReadListingResponse
    {
        $listings = (new PdoListingRepository())->read($request);

        return new ReadListingResponse($listings);
    }

    public function fetchSingle(ReadListingRequest $request): ReadListingResponse
    {
        $listings = (new PdoListingRepository())->fetchSingle($request);

        return new ReadListingResponse($listings);
    }

    public function fetchAll(): ReadListingResponse
    {
        $listings = (new PdoListingRepository())->fetchAll();

        return new ReadListingResponse($listings);
    }
}