<?php declare(strict_types=1);

namespace App\Core;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;

class Database
{
    /**
     * @throws Exception
     */
    public static function connect(): QueryBuilder
    {
        $connectionParams = [
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['HOST'],
            'driver' => $_ENV['DRIVER']
        ];

        return DriverManager::getConnection($connectionParams)->createQueryBuilder();
    }
}