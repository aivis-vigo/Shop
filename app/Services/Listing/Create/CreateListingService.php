<?php declare(strict_types=1);

namespace App\Services\Listing\Create;

use App\Repositories\Listing\PdoListingRepository;

class CreateListingService
{
    // TODO: select sections
    // TODO: display sections in list
    // TODO: based on selected section display sections options (Vue.js)
    public function execute(CreateListingRequest $request): void
    {
        (new PdoListingRepository)->create($request);
    }
}