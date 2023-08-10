<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Services\Option\Read\ReadOptionService;
use App\Services\Option\Read\ReadOptionsRequest;

class OptionController
{
    public function index(array $vars): TwigView
    {
        $authorized = $_SESSION['authorized'];
        $sectionId = (int)$vars['id'];

        $options = (new ReadOptionService())->execute(new ReadOptionsRequest($sectionId));

        return new TwigView('options', [
            'authorized' => isset($authorized),
            'options' => $options->options()
        ]);
    }
}