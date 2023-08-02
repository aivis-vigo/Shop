<?php declare(strict_types=1);

use App\Controllers\DashboardController;
use App\Controllers\RegistrationController;
use App\Controllers\AuthorizationController;
use App\Controllers\UserController;

return [
    // Home
    ['GET', '/', [DashboardController::class, 'index']],

    // Registration
    ['GET', '/register', [RegistrationController::class, 'index']],
    ['POST', '/create-user', [UserController::class, 'create']],

    // Login
    ['GET', '/login', [AuthorizationController::class, 'login']],

    // Profile
    ['GET', '/profile', [UserController::class, 'show']],
    ['GET', '/profile/update', [UserController::class, 'show']],
    ['POST', '/profile/delete', [UserController::class, 'delete']],

    // Logout
    ['GET', '/logout', [AuthorizationController::class, 'logout']],

    // Test
    ['GET', '/test', [UserController::class, 'show']],
];