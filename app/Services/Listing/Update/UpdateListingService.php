<?php declare(strict_types=1);

namespace App\Services\Listing\Update;

use App\Repositories\Listing\PdoListingRepository;

class UpdateListingService
{
    public function execute(UpdateListingRequest $request): UpdateListingResponse
    {
        $status = (new PdoListingRepository())->update($request);

        return new UpdateListingResponse($status);
    }
}