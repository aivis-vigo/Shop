<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\Redirect;
use App\Core\TwigView;
use App\Services\Listing\Read\ReadListingService;
use App\Services\Option\Create\CreateOptionRequest;
use App\Services\Option\Create\CreateOptionService;
use App\Services\Option\Delete\DeleteOptionRequest;
use App\Services\Option\Delete\DeleteOptionService;
use App\Services\Option\Read\ReadOptionService;
use App\Services\Option\Read\ReadOptionsRequest;
use App\Services\Option\Update\UpdateOptionRequest;
use App\Services\Option\Update\UpdateOptionService;

class OptionController
{
    public function index(array $vars): TwigView
    {
        $authorized = $_SESSION['authorized'];
        $sectionId = (int)$vars['id'];

        $response = (new ReadOptionService())->execute(new ReadOptionsRequest($sectionId));

        $options = $this->structureOptions($response->data());

        return new TwigView('Options/options', [
            'authorized' => isset($authorized),
            'options' => $options,
            'id' => reset($options)['section_id']
        ]);
    }

    public function show(): TwigView
    {
        $authorized = $_SESSION['authorized'];
        $sectionId = $_POST['section_id'];

        return new TwigView('Options/createOption', [
            'authorized' => isset($authorized),
            'sectionId' => $sectionId
        ]);
    }

    public function create(): Redirect
    {
        $option = $_POST;

        $status = (new CreateOptionService())->execute(new CreateOptionRequest($option));

        setcookie('status', $status->message(), time() + 10);

        return new Redirect('/');
    }

    public function edit(): TwigView
    {
        $authorized = $_SESSION['authorized'];
        $id = (int)$_POST['section_id'];

        $options = (new ReadOptionService())->edit(new ReadOptionsRequest($id));
        $listings = (new ReadListingService())->fetchAll();

        $updatedOptions = $this->checkDisabled($options->data(), $listings->listings());

        return new TwigView('Options/editOptions', [
            'authorized' => isset($authorized),
            'options' => $updatedOptions
        ]);
    }

    public function editOption(): TwigView
    {
        $authorized = $_SESSION['authorized'];

        $option = $_POST;

        return new TwigView('Options/editOption', [
            'authorized' => isset($authorized),
            'option' => $option
        ]);
    }

    public function update(): Redirect
    {
        $option = $_POST;

        $status = (new UpdateOptionService())->execute(new UpdateOptionRequest($option));

        setcookie('status', $status->message(), time() + 10);

        return new Redirect('/');
    }

    public function delete(): Redirect
    {
        $option = $_POST;

        $status = (new DeleteOptionService())->execute(new DeleteOptionRequest($option));

        setcookie('status', $status->message(), time() + 10);

        return new Redirect('/');
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

    private function checkDisabled(array $options, array $listings): array
    {
        $disabledOptions = [];
        $updatedOptions = [];

        foreach ($listings as $listing) {
            if (!in_array($listing['option_name'], $disabledOptions)) {
                $disabledOptions[] = $listing['option_name'];
            }
        }

        foreach ($options as $option) {
            if (in_array($option['title'], $disabledOptions)) {
                $option['disabled'] = true;
            } else {
                $option['disabled'] = false;
            }

            $updatedOptions[] = $option;
        }

        return $updatedOptions;
    }
}