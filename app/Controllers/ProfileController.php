<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;

class ProfileController
{
    public function index(): TwigView
    {
        var_dump($_SESSION);

        return new TwigView('Profile/profile', []);
    }
}