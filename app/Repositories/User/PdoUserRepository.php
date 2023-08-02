<?php declare(strict_types=1);

namespace App\Repositories\User;

use App\Core\Database;
use App\Exceptions\PasswordsDoNotMatchException;
use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use App\Services\User\Update\UpdateUserRequest;
use Carbon\Carbon;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;
use PDOException;
use function header;

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

    public function create(User $user): void
    {
        try {
            $password = password_hash($user->password(), PASSWORD_BCRYPT);

            $this->query
                ->insert('Users')
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

    // TODO: need to add ID to SESSION
    public function read(): ?User
    {
        try {
            $user = $this->query
                ->select("*")
                ->from("users")
                ->where("id = ?")
                ->setParameter(0, 51)
                ->fetchAssociative();

            return $this->buildUser($user);
        } catch (PDOException|Exception) {
            return null;
        }
    }

    // TODO: add into table updated_at field
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
                ->where('id = ' . 51)
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
            $user['firstName'],
            $user['lastName'],
            $user['email'],
            $user['password']
        );
    }
}