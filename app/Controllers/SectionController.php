<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Services\Option\Read\ReadOptionsRequest;
use App\Services\Section\Read\ReadSectionService;
use App\Services\Option\Read\ReadOptionService;

// TODO: options should have separate controller
// TODO: numbers like 500 should be 500 not 5
class SectionController
{
    public function index(): TwigView
    {
        $sections = (new ReadSectionService())->execute()->data();

        return new TwigView('home', [
            'authorized' => isset($_SESSION['authorized']),
            'status' => isset($_COOKIE['status']),
            'message' => $_COOKIE['status'] ?? null,
            'sections' => $sections
        ]);
    }

    // TODO: display number of each options listings
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