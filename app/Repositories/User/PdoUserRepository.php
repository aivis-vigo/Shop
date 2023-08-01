<?php declare(strict_types=1);

namespace App\Repositories\User;

use App\Core\Database;
use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
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
        $newUser = $this->buildModel($user);

        try {
            $validateUser = $this->query
                ->select('*')
                ->from('users')
                ->where('email = ?')
                ->setParameter(0, $newUser->email())
                ->executeStatement();

            if ($validateUser > 0) throw new UserAlreadyExistsException();

            $this->create($newUser);
        } catch (UserAlreadyExistsException|Exception) {
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
                        'created_at' => '?'
                    ]
                )
                ->setParameter(0, $user->firstName())
                ->setParameter(1, $user->lastName())
                ->setParameter(2, $user->email())
                ->setParameter(3, $password)
                ->setParameter(4, Carbon::now()->toDateTimeString())
                ->executeQuery();

            session_regenerate_id();

            $_SESSION['id'] = 11;

            header("Location: http://localhost:8000/profile");
            exit;
        } catch (PDOException|Exception) {
            return;
        }
    }

    public function read(): array
    {
        return $this->query
            ->select("*")
            ->from("Users")
            ->where("email = ?")
            ->setParameter(0, "aivisvigoreimarts@gmail.com")
            ->fetchAssociative();
    }

    public function update()
    {
        // Update user info
    }

    public function delete()
    {
        // Delete user
    }

    private function buildModel(array $user): User
    {
        return new User(
            $user['firstName'],
            $user['lastName'],
            $user['email'],
            $user['password']
        );
    }
}