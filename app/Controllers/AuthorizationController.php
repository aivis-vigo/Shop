<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;

class AuthorizationController
{
    public function __construct()
    {
    }

    public function login(): TwigView
    {
        return new TwigView('Authorization/login', []);
    }

    public function logout()
    {
        // User logs out
    }
}