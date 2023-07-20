<?php declare(strict_types=1);

namespace App\Controllers;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;

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
        $this->queryBuilder
            ->insert('Users')
            ->values(
                [
                    'firstName' => '?',
                    'lastName' => '?',
                    'password' => '?'
                ]
            )
            ->setParameter(0, $_POST['firstName'])
            ->setParameter(1, $_POST['lastName'])
            ->setParameter(2, $_POST['password'])
            ->executeQuery();
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