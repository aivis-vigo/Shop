<?php declare(strict_types=1);

namespace App\Services\Listing\Delete;

use App\Repositories\Listing\PdoListingRepository;

class DeleteListingService
{
    public function execute(DeleteListingRequest $request): DeleteListingResponse
    {
        $status = (new PdoListingRepository())->delete($request);

        return new DeleteListingResponse($status);
    }
}