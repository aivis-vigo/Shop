<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;

class LoginController
{
    public function login(): TwigView
    {
        return new TwigView('Authorization/login', []);
    }

    public function logout(): void
    {
        session_start();
        session_destroy();
        header('Location: http://localhost:8000/login');
    }
}