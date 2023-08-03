<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Services\User\Read\ReadUserRequest;
use App\Services\User\Read\ReadUserService;

class AuthorizationController
{
    public function index(): TwigView
    {
        return new TwigView('Authorization/login', [
            'authorized' => isset($_SESSION['authorized']),
        ]);
    }

    public function login(): void
    {
        $user = (new ReadUserService())->execute(new ReadUserRequest($_POST['email']))->data();

        $validatePassword = password_verify($_POST['password'], $user['password']);

        if ($validatePassword) {
            session_regenerate_id();

            $_SESSION['authorized'] = true;
            $_SESSION['email'] = $user['email'];

            header('Location: http://localhost:8000/profile');
            exit;
        }

        header('Location: http://localhost:8000/login');
        exit;
    }

    public function logout(): void
    {
        session_destroy();

        header('Location: http://localhost:8000/login');
        exit;
    }
}