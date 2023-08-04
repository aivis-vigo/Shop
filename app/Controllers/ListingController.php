<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Services\Listing\CreateListingRequest;
use App\Services\Listing\CreateListingService;
use App\Services\Option\Read\ReadOptionService;

class ListingController
{
    // TODO: display listing option title
    // TODO: pass listing option title as id
    public function index(): TwigView
    {
        $options = (new ReadOptionService())->fetchAll()->options();

        return new TwigView('create-listing', [
            'authorized' => isset($_SESSION['authorized']),
            'options' => $options
        ]);
    }

    public function create(): void
    {
        (new CreateListingService())->execute(new CreateListingRequest($_POST));

        // TODO: redirect to created listing
        header("location: http://localhost:8000");
        exit;
    }
}