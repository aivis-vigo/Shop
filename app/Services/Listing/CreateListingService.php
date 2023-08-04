<?php declare(strict_types=1);

namespace App\Services\Listing;

use App\Repositories\Listing\PdoListingRepository;

class CreateListingService
{
    public function execute(CreateListingRequest $request): void
    {
        (new PdoListingRepository)->create($request);
    }
}