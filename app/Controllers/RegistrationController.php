<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Models\User;

class  RegistrationController
{
    private User $user;
    public function __construct()
    {
    }

    public function index(): TwigView
    {
        return new TwigView('Authorization/register', []);
    }
}