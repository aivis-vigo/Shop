<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Services\Listing\Create\CreateListingRequest;
use App\Services\Listing\Create\CreateListingService;
use App\Services\Listing\Read\ReadListingRequest;
use App\Services\Listing\Read\ReadListingService;
use App\Services\Option\Read\ReadOptionService;

class ListingController
{
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

    public function read(array $vars): TwigView
    {
        $listings = (int)$vars['id'];

        $listings = (new ReadListingService())->execute(new ReadListingRequest($listings))->listings();
        var_dump($listings);

        return new TwigView('listings', [
            'authorized' => isset($_SESSION['authorized']),
            'listings' => $listings
        ]);
    }
}