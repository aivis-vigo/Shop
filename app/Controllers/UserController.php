<?php declare(strict_types=1);

namespace App\Controllers;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Schema\Schema;

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
                ->setParameter(2, $_POST['email'], 'unique')
                ->setParameter(3, $_POST['password'])
                ->executeQuery();
        } catch (UniqueConstraintViolationException) {
            var_dump('aaa');die;
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