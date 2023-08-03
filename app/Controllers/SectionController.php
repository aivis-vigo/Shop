<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Services\Section\Read\ReadSectionService;

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
}