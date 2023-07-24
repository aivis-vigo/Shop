<?php declare(strict_types=1);

use App\Controllers\DashboardController;
use App\Controllers\RegistrationController;
use App\Controllers\AuthorizationController;
use App\Controllers\UserController;

return [
    // Login
    ['GET', '/login', [AuthorizationController::class, 'login']],

    // Registration
    ['GET', '/register', [RegistrationController::class, 'index']],
    ['POST', '/create-user', [UserController::class, 'create']],

    // Home
    ['GET', '/', [DashboardController::class, 'index']],
];