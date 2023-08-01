<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;

class DashboardController
{
    public function index(): TwigView
    {
        var_dump($_SESSION);

        return new TwigView('home', []);
    }
}