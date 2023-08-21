<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\Redirect;
use App\Core\TwigView;
use App\Services\Section\Create\CreateSectionRequest;
use App\Services\Section\Create\CreateSectionService;
use App\Services\Section\Delete\DeleteSectionRequest;
use App\Services\Section\Delete\DeleteSectionService;
use App\Services\Section\Read\ReadSectionService;

class SectionController
{
    public function index(): TwigView
    {
        $authorized = $_SESSION['authorized'] ?? null;
        $status = $_COOKIE['status'] ?? null;

        $response = (new ReadSectionService())->execute();

        $sections = $this->structureSections($response->data());

        return new TwigView('home', [
            'authorized' => isset($authorized),
            'status' => isset($status),
            'message' => $status,
            'sections' => $sections
        ]);
    }

    public function show(): TwigView
    {
        $authorized = $_SESSION['authorized'] ?? null;

        return new TwigView('createSection', [
            'authorized' => isset($authorized),
        ]);
    }

    public function create(): Redirect
    {
        $section = $_POST;

        (new CreateSectionService())->execute(new CreateSectionRequest($section));

        return new Redirect('/');
    }

    public function edit(): TwigView
    {
        $authorized = $_SESSION['authorized'] ?? null;

        $sections = (new ReadSectionService())->executeWithoutOptions();

        return new TwigView('editSections', [
            'authorized' => isset($authorized),
            'sections' => $sections->data()
        ]);
    }

    public function delete(): Redirect
    {
        $section = $_POST;

        (new DeleteSectionService())->execute(new DeleteSectionRequest($section));

        return new Redirect('/');
    }

    public function test()
    {
        $response = (new DeleteSectionService())->test();

        echo "<pre>";
        var_dump($response);
        echo "<pre>";
    }

    private function structureSections(array $sections): array
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