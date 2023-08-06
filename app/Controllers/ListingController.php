<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\Redirect;
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

        return new TwigView('Listings/create-listing', [
            'authorized' => isset($_SESSION['authorized']),
            'options' => $options
        ]);
    }

    public function show(array $vars): TwigView
    {
        $id = (int)($vars['listing']);

        $listing = (new ReadListingService())->fetchSingle(new ReadListingRequest($id))->listings();

        return new TwigView('Listings/listing', [
            'authorized' => isset($_SESSION['authorized']),
            'listing' => $listing
        ]);
    }

    public function create(): Redirect
    {
        $status = (new CreateListingService())->execute(new CreateListingRequest($_POST));

        setcookie('status', $status->message(), time() + 10);

        // TODO: redirect to created listing
        return new Redirect('/');
    }

    public function read(array $vars): TwigView
    {
        $listings = (int)$vars['id'];

        $listings = (new ReadListingService())->execute(new ReadListingRequest($listings))->listings();

        return new TwigView('Listings/listings', [
            'authorized' => isset($_SESSION['authorized']),
            'listings' => $listings
        ]);
    }
}