<?php declare(strict_types=1);

namespace App\Repositories\User;

use App\Core\Database;
use App\Exceptions\PasswordsDoNotMatchException;
use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use App\Services\User\Password\UpdatePasswordRequest;
use App\Services\User\Update\UpdateUserRequest;
use Carbon\Carbon;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;
use PDOException;
use function header;

// TODO: return status message for action
class PdoUserRepository
{
    private QueryBuilder $query;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->query = Database::connect();
    }

    public function validate(array $user): void
    {
        $newUser = $this->buildUser($user);
        $confirmPassword = $user['confirm-password'];

        try {
            $validateUser = $this->query
                ->select('*')
                ->from('users')
                ->where('email = ?')
                ->setParameter(0, $newUser->email())
                ->executeStatement();

            if ($validateUser > 0) throw new UserAlreadyExistsException();
            if ($newUser->password() !== $confirmPassword) throw new PasswordsDoNotMatchException();

            $this->create($newUser);
        } catch (UserAlreadyExistsException|PasswordsDoNotMatchException|Exception) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function validatePassword(UpdatePasswordRequest $user): void
    {
        try {
            $currentPassword = $this->query
                ->select('password')
                ->from('users')
                ->where('id = ?')
                ->setParameter(0, $user->id())
                ->fetchOne();

            $currentPasswordMatch = password_verify($user->currentPassword(), $currentPassword);
            $newPasswordsMatch = ($user->newPassword() == $user->confirmNewPassword());
            $newPassword = password_hash($user->newPassword(), PASSWORD_BCRYPT);

            if ($currentPasswordMatch && $newPasswordsMatch) $this->updatePassword($user->id(), $newPassword);
        } catch (PDOException|Exception) {
            return;
        }
    }

    public function create(User $user): void
    {
        try {
            $password = password_hash($user->password(), PASSWORD_BCRYPT);

            $this->query
                ->insert('users')
                ->values(
                    [
                        'firstName' => '?',
                        'lastName' => '?',
                        'email' => '?',
                        'password' => '?',
                        'created_at' => '?',
                        'updated_at' => '?'
                    ]
                )
                ->setParameter(0, $user->firstName())
                ->setParameter(1, $user->lastName())
                ->setParameter(2, $user->email())
                ->setParameter(3, $password)
                ->setParameter(4, Carbon::now()->toDateTimeString())
                ->setParameter(5, Carbon::now()->toDateTimeString())
                ->executeQuery();

            session_regenerate_id();

            $_SESSION['authorized'] = true;
            $_SESSION['email'] = $user->email();

            header("Location: http://localhost:8000/profile");
            exit;
        } catch (PDOException|Exception) {
            return;
        }
    }

    public function read(string $email): ?User
    {
        try {
            $user = $this->query
                ->select("*")
                ->from("users")
                ->where("email = ?")
                ->setParameter(0, $email)
                ->fetchAssociative();

            $activeUser = $this->buildUser($user);

            $_SESSION['id'] = $activeUser->id();

            return $activeUser;
        } catch (PDOException|Exception) {
            return null;
        }
    }

    public function update(UpdateUserRequest $user): void
    {
        try {
            $this->query
                ->update('users')
                ->set('firstName', '?')
                ->set('lastName', '?')
                ->set('email', '?')
                ->set('updated_at', '?')
                ->setParameter(1, $user->firstName())
                ->setParameter(2, $user->lastName())
                ->setParameter(3, $user->email())
                ->setParameter(4, Carbon::now()->toDateTimeString())
                ->where('id = ' . $user->id())
                ->executeQuery();

            $_SESSION['email'] = $user->email();
        } catch (PDOException|Exception) {
            return;
        }
    }

    public function updatePassword(int $id, string $newPassword): void
    {
        try {
            $this->query
                ->update('users')
                ->set('password', '?')
                ->setParameter(0, $newPassword)
                ->where('id = ' . $id)
                ->executeQuery();
        } catch (PDOException|Exception) {
            return;
        }
    }

    public function delete(string $user): void
    {
        try {
            $this->query
                ->delete('users')
                ->where('email = ?')
                ->setParameter(0, $user)
                ->executeQuery();

            session_destroy();
        } catch (Exception) {
            return;
        }
    }

    private function buildUser(array $user): User
    {
        return new User(
            $user['id'],
            $user['firstName'],
            $user['lastName'],
            $user['email'],
            $user['password']
        );
    }
}