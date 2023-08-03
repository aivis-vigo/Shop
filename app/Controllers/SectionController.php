<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
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
            'sections' => $sections
        ]);
    }

    public function show(): TwigView
    {
        $options = (new ReadOptionService())->execute()->options();

        var_dump($options);

        return new TwigView('home', [
            'authorized' => isset($_SESSION['authorized']),
            'options' => $options
        ]);
    }
}