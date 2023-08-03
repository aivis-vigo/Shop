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
    ['GET', '/login', [AuthorizationController::class, 'index']],
    ['POST', '/login/validate', [AuthorizationController::class, 'login']],

    // Profile
    ['GET', '/profile', [UserController::class, 'show']],
    ['GET', '/profile/update', [UserController::class, 'show']],
    ['POST', '/profile/process-update', [UserController::class, 'update']],
    ['POST', '/profile/password-update', [UserController::class, 'updatePassword']],
    ['POST', '/profile/delete', [UserController::class, 'delete']],

    // Logout
    ['GET', '/logout', [AuthorizationController::class, 'logout']],
];