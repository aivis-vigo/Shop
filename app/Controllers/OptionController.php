<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Repositories\Option\PdoOptionRepository;
use App\Services\Listing\Read\ReadListingRequest;
use App\Services\Listing\Read\ReadListingService;
use App\Services\Option\Read\ReadOptionService;
use App\Services\Option\Read\ReadOptionsRequest;

class OptionController
{
    public function index(array $vars): TwigView
    {
        $authorized = $_SESSION['authorized'];
        $sectionId = (int)$vars['id'];

        $response = (new ReadOptionService())->execute(new ReadOptionsRequest($sectionId));

        $options = $this->structureOptions($response->data());

        return new TwigView('options', [
            'authorized' => isset($authorized),
            'options' => $options,
            'id' => reset($options)['section_id']
        ]);
    }

    public function edit(): TwigView
    {
        $authorized = $_SESSION['authorized'];
        $id = (int)$_POST['section_id'];

        $options = (new ReadOptionService())->edit(new ReadOptionsRequest($id));
        $listings = (new ReadListingService())->fetchByOptionTitle();
        echo "<pre>";
        var_dump($_POST);
        echo "<pre>";

        return new TwigView('editOptions', [
            'authorized' => isset($authorized)
        ]);
    }

    private function structureOptions(array $options): array
    {
        $collected = [];

        foreach ($options as $listing) {
            if (!isset($collected[$listing['id']])) {
                $collected[$listing['id']] = [
                    'title' => $listing['title'],
                    'id' => $listing['id'],
                    'section_id' => $listing['section_id'],
                    'listings' => []
                ];
            }

            if (isset($listing['option_name'])) $collected[$listing['id']]['listings'][] = $listing['option_name'];
        }

        asort($collected);

        return $collected;
    }
}