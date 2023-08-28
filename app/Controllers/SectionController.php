<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\Redirect;
use App\Core\TwigView;
use App\Models\Section;
use App\Services\Section\Create\CreateSectionRequest;
use App\Services\Section\Create\CreateSectionService;
use App\Services\Section\Delete\DeleteSectionRequest;
use App\Services\Section\Delete\DeleteSectionService;
use App\Services\Section\Read\ReadSectionService;
use App\Services\Section\Update\UpdateSectionRequest;
use App\Services\Section\Update\UpdateSectionService;

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

        return new TwigView('Sections/createSection', [
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
        $listings = (new DeleteSectionService())->disableDelete();

        $updatedSections = $this->checkDisabled($sections->data(), $listings);

        return new TwigView('Sections/editSections', [
            'authorized' => isset($authorized),
            'sections' => $updatedSections
        ]);
    }

    public function editSection(): TwigView
    {
        $data = $_POST;
        $section = new Section($data);

        $display = $this->buildModel($section);

        return new TwigView('Sections/editSection', [
            'authorized' => isset($authorized),
            'section' => $display
        ]);
    }

    public function update(): Redirect
    {
        $section = $_POST;

        (new UpdateSectionService())->execute(new UpdateSectionRequest($section));

        return new Redirect('/');
    }

    public function delete(): Redirect
    {
        $section = $_POST;

        (new DeleteSectionService())->execute(new DeleteSectionRequest($section));

        return new Redirect('/');
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

    private function checkDisabled(array $sections, array $listings): array
    {
        $disabledSections = [];
        $updatedSections = [];

        foreach ($listings as $listing) {
            if (!in_array($listing['section'], $disabledSections)) {
                $disabledSections[] = $listing['section'];
            }
        }

        foreach ($sections as $section) {
            if (in_array($section['title'], $disabledSections)) {
                $section['disabled'] = true;
            } else {
                $section['disabled'] = false;
            }

            $updatedSections[] = $section;
        }

        return $updatedSections;
    }

    private function buildModel(Section $section): array
    {
        return [
            'id' => $section->id(),
            'title' => $section->title(),
            'description' => $section->description(),
        ];
    }
}