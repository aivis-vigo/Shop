<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Services\Option\Read\ReadOptionsRequest;
use App\Services\Section\Read\ReadSectionService;
use App\Services\Option\Read\ReadOptionService;

class SectionController
{
    public function index(): TwigView
    {
        $authorized = $_SESSION['authorized'] ?? null;
        $status = $_COOKIE['status'] ?? null;

        $response = (new ReadSectionService())->execute();

        $sections = $this->structureSection($response->data());

        return new TwigView('home', [
            'authorized' => isset($authorized),
            'status' => isset($status),
            'message' => $status,
            'sections' => $sections
        ]);
    }

    private function structureSection(array $sections): array
    {
        $sectionOptions = [];

        foreach ($sections as $option) {
            if (!isset($sectionOptions[$option['section_id']])) {
                $sectionOptions[$option['section_id']] = [
                    'title' => $option['section'],
                    'description' => $option['description'],
                    'id' => $option['section_id'],
                    'options' => []
                ];
            }

            $sectionOptions[$option['section_id']]['options'][] = [
                'title' => $option['title'],
            ];
        }

        asort($sectionOptions);

        return $sectionOptions;
    }
}