<?php declare(strict_types=1);

use App\Controllers\ListingController;
use App\Controllers\OptionController;
use App\Controllers\RegistrationController;
use App\Controllers\AuthorizationController;
use App\Controllers\SectionController;
use App\Controllers\UserController;

return [
    // Home/Sections
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
    ['POST', '/profile/process-update', [UserController::class, 'updateInfo']],
    ['POST', '/profile/password-update', [UserController::class, 'updatePassword']],
    ['POST', '/profile/delete', [UserController::class, 'delete']],

    // Create listing
    ['GET', '/create-listing', [ListingController::class, 'index']],
    ['POST', '/save-listing', [ListingController::class, 'create']],

    // Section subsections
    ['GET', '/jobs/{id:\d+}', [OptionController::class, 'index']],
    ['GET', '/electronics/{id:\d+}', [OptionController::class, 'index']],
    ['GET', '/transport/{id:\d+}', [OptionController::class, 'index']],
    ['GET', '/clothing/{id:\d+}', [OptionController::class, 'index']],
    ['GET', '/animals/{id:\d+}', [OptionController::class, 'index']],
    ['GET', '/properties/{id:\d+}', [OptionController::class, 'index']],
    ['GET', '/furniture/{id:\d+}', [OptionController::class, 'index']],
    ['GET', '/hobbies/{id:\d+}', [OptionController::class, 'index']],

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
    ['GET', '/jobs/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/electronics/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/transport/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/clothing/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/animals/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/properties/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/furniture/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/hobbies/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],

    // Logout
    ['GET', '/logout', [AuthorizationController::class, 'logout']],
];