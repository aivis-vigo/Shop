<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Services\Option\Read\ReadOptionsRequest;
use App\Services\Section\Read\ReadSectionService;
use App\Services\Option\Read\ReadOptionService;

// TODO: options should have separate service
// TODO: create a view for options to be displayed
class SectionController
{
    public function index(): TwigView
    {
        $sections = (new ReadSectionService())->execute()->data();

        return new TwigView('home', [
            'authorized' => isset($_SESSION['authorized']),
            'status' => isset($_COOKIE['status']),
            'sections' => $sections
        ]);
    }

    // TODO: display number of how many is being sold
    public function show(array $vars): TwigView
    {
        $sectionId = (int)$vars['id'];

        $options = (new ReadOptionService())->execute(new ReadOptionsRequest($sectionId))->options();

        return new TwigView('options', [
            'authorized' => isset($_SESSION['authorized']),
            'options' => $options
        ]);
    }
}