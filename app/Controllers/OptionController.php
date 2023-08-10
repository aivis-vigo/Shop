<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Services\Option\Read\ReadOptionService;
use App\Services\Option\Read\ReadOptionsRequest;

// TODO: finished the day here
class OptionController
{
    public function index(array $vars): TwigView
    {
        $authorized = $_SESSION['authorized'];
        $sectionId = (int)$vars['id'];

        $options = (new ReadOptionService())->execute(new ReadOptionsRequest($sectionId));
        var_dump($options->data());

        return new TwigView('options', [
            'authorized' => isset($authorized),
            'options' => $options->data()
        ]);
    }
}