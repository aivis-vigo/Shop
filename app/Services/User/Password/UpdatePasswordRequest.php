<?php declare(strict_types=1);

namespace App\Services\User\Password;

class UpdatePasswordRequest
{
    private int $id;
    private string $currentPassword;
    private string $newPassword;
    private string $confirmNewPassword;

    public function __construct(int $id, array $user)
    {
        $this->id = $id;
        $this->currentPassword = $user['current-password'];
        $this->newPassword = $user['new-password'];
        $this->confirmNewPassword = $user['confirm-new-password'];
    }

    public function id(): int
    {
        return $this->id;
    }

    public function currentPassword(): string
    {
        return $this->currentPassword;
    }

    public function newPassword(): string
    {
        return $this->newPassword;
    }

    public function confirmNewPassword(): string
    {
        return $this->confirmNewPassword;
    }
}