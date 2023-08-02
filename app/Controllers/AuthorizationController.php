<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;

class AuthorizationController
{
    public function login(): TwigView
    {
        // todo: login functionality
        return new TwigView('Authorization/login', [
            'authorized' => isset($_SESSION['authorized']),
        ]);
    }

    public function logout(): void
    {
        session_destroy();

        header('Location: http://localhost:8000/login');
    }
}