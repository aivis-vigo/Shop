<?php declare(strict_types=1);

namespace App\Services\Listing\Create;

use App\Repositories\Listing\PdoListingRepository;

class CreateListingService
{
    // TODO: select sections
    // TODO: select display sections options
    // TODO: display options in the same way as previously (Vue.js)
    public function execute(CreateListingRequest $request): void
    {
        (new PdoListingRepository)->create($request);
    }
}