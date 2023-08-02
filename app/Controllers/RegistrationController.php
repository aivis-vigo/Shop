<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;

class  RegistrationController
{
    public function index(): TwigView
    {
        return new TwigView('Authorization/register', [
            'authorized' => isset($_SESSION['authorized']),
        ]);
    }
}