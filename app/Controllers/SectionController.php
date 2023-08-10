<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Services\Option\Read\ReadOptionsRequest;
use App\Services\Section\Read\ReadSectionService;
use App\Services\Option\Read\ReadOptionService;

class SectionController
{
    // TODO: description -> section_name
    // TODO: add section description field
    public function index(): TwigView
    {
        $sectionOptions = [];
        $authorized = $_SESSION['authorized'];
        $status = $_COOKIE['status'] ?? null;

        $sections = (new ReadSectionService())->execute();

        foreach ($sections->data() as $option) {
            if (!isset($sectionOptions[$option['section_id']])) {
                $sectionOptions[$option['section_id']] = [
                    'title' => $option['description'],
                    'id' => $option['section_id'],
                    'options' => []
                ];
            }

            $sectionOptions[$option['section_id']]['options'][] = [
                'title' => $option['title'],
            ];
        }

        asort($sectionOptions);

        return new TwigView('home', [
            'authorized' => isset($authorized),
            'status' => isset($status),
            'message' => $status,
            'sections' => $sectionOptions
        ]);
    }

    // TODO: display number of each options listings
    // TODO: this should be OptionController index
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