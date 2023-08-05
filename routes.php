<?php declare(strict_types=1);

use App\Controllers\ListingController;
use App\Controllers\SectionController;
use App\Controllers\RegistrationController;
use App\Controllers\AuthorizationController;
use App\Controllers\UserController;

return [
    // Home
    ['GET', '/', [SectionController::class, 'index']],

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

    // Create listing
    ['GET', '/create-listing', [ListingController::class, 'index']],
    ['POST', '/save-listing', [ListingController::class, 'create']],

    // Sections
    ['GET', '/jobs/{id:\d+}', [SectionController::class, 'show']],
    ['GET', '/electronics/{id:\d+}', [SectionController::class, 'show']],
    ['GET', '/transport/{id:\d+}', [SectionController::class, 'show']],
    ['GET', '/clothing/{id:\d+}', [SectionController::class, 'show']],
    ['GET', '/animals/{id:\d+}', [SectionController::class, 'show']],
    ['GET', '/properties/{id:\d+}', [SectionController::class, 'show']],
    ['GET', '/furniture/{id:\d+}', [SectionController::class, 'show']],
    ['GET', '/hobbies/{id:\d+}', [SectionController::class, 'show']],

    // Display All Listings
    ['GET', '/jobs/{title}/{id:\d+}/', [ListingController::class, 'read']],
    ['GET', '/electronics/{title}/{id:\d+}/', [ListingController::class, 'read']],
    ['GET', '/transport/{title}/{id:\d+}/', [ListingController::class, 'read']],
    ['GET', '/clothing/{title}/{id:\d+}/', [ListingController::class, 'read']],
    ['GET', '/animals/{title}/{id:\d+}/', [ListingController::class, 'read']],
    ['GET', '/properties/{title}/{id:\d+}/', [ListingController::class, 'read']],
    ['GET', '/furniture/{title}/{id:\d+}/', [ListingController::class, 'read']],
    ['GET', '/hobbies/{title}/{id:\d+}/', [ListingController::class, 'read']],

    // Display Selected Listings
    ['GET', '/electronics/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],

    // Logout
    ['GET', '/logout', [AuthorizationController::class, 'logout']],
];