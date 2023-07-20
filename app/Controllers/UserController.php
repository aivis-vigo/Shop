<?php declare(strict_types=1);

namespace App\Controllers;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use RuntimeException;
use function header;

class UserController
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

    public function create(): void
    {
        try {
            $users = $this->queryBuilder
                ->select('*')
                ->from('Users')
                ->where('email = ?')
                ->setParameter(0, $_POST['email'])
                ->fetchAllAssociative();

            if (count($users) > 0) {
                throw new RuntimeException;
            }

            $this->queryBuilder
                ->insert('Users')
                ->values(
                    [
                        'firstName' => '?',
                        'lastName' => '?',
                        'email' => '?',
                        'password' => '?'
                    ]
                )
                ->setParameter(0, $_POST['firstName'])
                ->setParameter(1, $_POST['lastName'])
                ->setParameter(2, $_POST['email'])
                ->setParameter(3, $_POST['password'])
                ->executeQuery();

            header('Location: http://localhost:8000/home');
        } catch (RuntimeException) {
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