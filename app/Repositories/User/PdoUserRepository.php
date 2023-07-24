<?php declare(strict_types=1);

namespace App\Repositories\User;

use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use Carbon\Carbon;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use function header;

class PdoUserRepository
{
    private Connection $connection;
    private QueryBuilder $queryBuilder;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['HOST'],
            'driver' => $_ENV['DRIVER']
        ];

        $this->connection = DriverManager::getConnection($connectionParams);
        $this->queryBuilder = $this->connection->createQueryBuilder();
    }

    public function create(User $user): void
    {
        try {
            $existingUser = $this->queryBuilder
                ->select('*')
                ->from('Users')
                ->where('email = ?')
                ->setParameter(0, $_POST['email'])
                ->fetchAllAssociative();

            if (count($existingUser) > 0) {
                throw new UserAlreadyExistsException();
            }

            $this->queryBuilder
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
                ->setParameter(3, password_hash($user->password(), PASSWORD_BCRYPT))
                ->setParameter(4, Carbon::now()->toDateTimeString())
                ->executeQuery();

            session_start();
            session_regenerate_id();

            header('Location: http://localhost:8000/profile');
        } catch (UserAlreadyExistsException) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function read()
    {
        // Get user info
    }

    public function update()
    {
        // Update user info
    }

    public function delete()
    {
        // Delete user
    }
}