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

    // Sections
    ['GET', '/create-section', [SectionController::class, 'show']],
    ['POST', '/create-section/process', [SectionController::class, 'create']],
    ['GET', '/edit-sections', [SectionController::class, 'edit']],
    ['POST', '/delete-section', [SectionController::class, 'delete']],

    // Edit Sections
    ['POST', '/jobs/edit', [SectionController::class, 'editSection']],
    ['POST', '/electronics/edit', [SectionController::class, 'editSection']],
    ['POST', '/transport/edit', [SectionController::class, 'editSection']],
    ['POST', '/clothing/edit', [SectionController::class, 'editSection']],
    ['POST', '/animals/edit', [SectionController::class, 'editSection']],
    ['POST', '/properties/edit', [SectionController::class, 'editSection']],
    ['POST', '/furniture/edit', [SectionController::class, 'editSection']],
    ['POST', '/hobbies/edit', [SectionController::class, 'editSection']],

    // Update Sections
    ['POST', '/jobs/update', [SectionController::class, 'update']],
    ['POST', '/electronics/update', [SectionController::class, 'update']],
    ['POST', '/transport/update', [SectionController::class, 'update']],
    ['POST', '/clothing/update', [SectionController::class, 'update']],
    ['POST', '/animals/update', [SectionController::class, 'update']],
    ['POST', '/properties/update', [SectionController::class, 'update']],
    ['POST', '/furniture/update', [SectionController::class, 'update']],
    ['POST', '/hobbies/update', [SectionController::class, 'update']],

    // Edit Subsections
    ['POST', '/options/edit', [OptionController::class, 'edit']],

    ['POST', '/pilot/edit', [OptionController::class, 'editOption']],
    ['POST', '/officer/edit', [OptionController::class, 'editOption']],
    ['POST', '/phones/edit', [OptionController::class, 'editOption']],
    ['POST', '/tablets/edit', [OptionController::class, 'editOption']],
    ['POST', '/trucks/edit', [OptionController::class, 'editOption']],
    ['POST', '/kids/edit', [OptionController::class, 'editOption']],
    ['POST', '/adults/edit', [OptionController::class, 'editOption']],
    ['POST', '/cats/edit', [OptionController::class, 'editOption']],
    ['POST', '/dogs/edit', [OptionController::class, 'editOption']],
    ['POST', '/hamsters/edit', [OptionController::class, 'editOption']],
    ['POST', '/houses/edit', [OptionController::class, 'editOption']],
    ['POST', '/flats/edit', [OptionController::class, 'editOption']],
    ['POST', '/offices/edit', [OptionController::class, 'editOption']],
    ['POST', '/couches/edit', [OptionController::class, 'editOption']],
    ['POST', '/beds/edit', [OptionController::class, 'editOption']],
    ['POST', '/chairs/edit', [OptionController::class, 'editOption']],
    ['POST', '/hockey/edit', [OptionController::class, 'editOption']],
    ['POST', '/basketball/edit', [OptionController::class, 'editOption']],

    // Update Sections
    ['POST', '/pilot/update', [OptionController::class, 'update']],
    ['POST', '/officer/update', [OptionController::class, 'update']],
    ['POST', '/phones/update', [OptionController::class, 'update']],
    ['POST', '/tablets/update', [OptionController::class, 'update']],
    ['POST', '/trucks/update', [OptionController::class, 'update']],
    ['POST', '/kids/update', [OptionController::class, 'update']],
    ['POST', '/adults/update', [OptionController::class, 'update']],
    ['POST', '/cats/update', [OptionController::class, 'update']],
    ['POST', '/dogs/update', [OptionController::class, 'update']],
    ['POST', '/hamsters/update', [OptionController::class, 'update']],
    ['POST', '/houses/update', [OptionController::class, 'update']],
    ['POST', '/flats/update', [OptionController::class, 'update']],
    ['POST', '/offices/update', [OptionController::class, 'update']],
    ['POST', '/couches/update', [OptionController::class, 'update']],
    ['POST', '/beds/update', [OptionController::class, 'update']],
    ['POST', '/chairs/update', [OptionController::class, 'update']],
    ['POST', '/hockey/update', [OptionController::class, 'update']],
    ['POST', '/basketball/update', [OptionController::class, 'update']],

    // Crete & Delete Subsection
    ['POST', '/create-option', [OptionController::class, 'show']],
    ['POST', '/create-option/process', [OptionController::class, 'create']],
    ['POST', '/delete-option', [OptionController::class, 'delete']],

    // Subsections
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

    // Show Listings
    ['GET', '/jobs/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/electronics/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/transport/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/clothing/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/animals/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/properties/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/furniture/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],
    ['GET', '/hobbies/{title}/{id:\d+}/{listing:\d+}', [ListingController::class, 'show']],

    // Edit & Update Listing
    ['POST', '/edit-listing', [ListingController::class, 'edit']],
    ['POST', '/update-listing', [ListingController::class, 'update']],

    // Delete Listing
    ['POST', '/delete-listing', [ListingController::class, 'delete']],

    // Logout
    ['GET', '/logout', [AuthorizationController::class, 'logout']],

    ['GET', '/test', [SectionController::class, 'test']],
];