<?php declare(strict_types=1);

namespace App\Services\Option\Update;

use App\Repositories\Option\PdoOptionRepository;

class UpdateOptionService
{
    public function execute(UpdateOptionRequest $option): UpdateOptionResponse
    {
        $status = (new PdoOptionRepository())->update($option);

        return new UpdateOptionResponse($status);
    }
}