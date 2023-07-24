<?php declare(strict_types=1);

use App\Controllers\DashboardController;
use App\Controllers\RegistrationController;
use App\Controllers\LoginController;
use App\Controllers\UserController;

return [
    // Home
    ['GET', '/', [DashboardController::class, 'index']],

    // Registration
    ['GET', '/register', [RegistrationController::class, 'index']],
    ['POST', '/create-user', [UserController::class, 'create']],

    // Login
    ['GET', '/login', [LoginController::class, 'login']],

    // Logout
    ['GET', '/logout', [LoginController::class, 'logout']],
];