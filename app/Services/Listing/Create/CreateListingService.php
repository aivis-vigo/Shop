<?php declare(strict_types=1);

namespace App\Services\Listing\Create;

use App\Repositories\Listing\PdoListingRepository;

class CreateListingService
{
    public function execute(CreateListingRequest $request): CreateListingResponse
    {
        $message = (new PdoListingRepository)->create($request);

        return new CreateListingResponse($message);
    }
}