<?php declare(strict_types=1);

namespace App\Repositories\Option;

use App\Core\Database;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;
use PDOException;

class PdoOptionRepository
{
    private QueryBuilder $query;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->query = Database::connect();
    }

    public function read(): ?array
    {
        try {
            return $this->query
                ->select('o.title')
                ->from('options', 'o')
                ->leftJoin('o', 'sections', 's', 's.id = 1')
                ->fetchAllAssociative();
        } catch (PDOException|Exception) {
            return null;
        }
    }
}