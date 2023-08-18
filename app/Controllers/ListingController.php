<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\Redirect;
use App\Core\TwigView;
use App\Services\Listing\Create\CreateListingRequest;
use App\Services\Listing\Create\CreateListingService;
use App\Services\Listing\Read\ReadListingRequest;
use App\Services\Listing\Read\ReadListingService;
use App\Services\Option\Read\ReadOptionService;
use App\Services\Section\Read\ReadSectionService;
use App\Services\User\Read\ReadUserRequest;
use App\Services\User\Read\ReadUserService;

// TODO: numbers like 500 should be 500 not 5
class ListingController
{
    public function index(): TwigView
    {
        $sections = (new ReadSectionService())->execute()->data();
        $options = (new ReadOptionService())->fetchAll()->data();

        return new TwigView('Listings/create-listing', [
            'authorized' => isset($_SESSION['authorized']),
            'sections' => $sections,
            'options' => $options
        ]);
    }

    public function show(array $vars): TwigView
    {
        $id = (int)($vars['listing']);

        $listing = (new ReadListingService())->fetchSingle(new ReadListingRequest($id))->listings();

        $author = $listing['author'];
        $user = (new ReadUserService())->execute(new ReadUserRequest($author))->data();

        return new TwigView('Listings/listing', [
            'authorized' => isset($_SESSION['authorized']),
            'listing' => $listing,
            'user' => $user
        ]);
    }

    // TODO: redirect to created listing
    public function create(): Redirect
    {
        $author = $_SESSION['email'];
        $listing = $_POST;

        $this->uploadPicture();

        $status = (new CreateListingService())->execute(new CreateListingRequest($author, $listing));

        setcookie('status', $status->message(), time() + 10);

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

    private function uploadPicture(): void
    {
        $title = random_int(10000, 99999) . '.jpg';
        $picture = $_FILES['file-upload']['tmp_name'];
        $path = __DIR__ . '/../../storage';

        if (file_exists("$path/$title")) {
            $title = random_int(10000, 99999) . '.jpg';
        }

        $filePath = "$path/$title";
        move_uploaded_file($picture, $filePath);
    }
}