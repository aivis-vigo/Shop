<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;

class DashboardController
{
    public function index(): TwigView
    {
        return new TwigView('home', [
            'authorized' => isset($_SESSION['authorized']),
        ]);
    }
}