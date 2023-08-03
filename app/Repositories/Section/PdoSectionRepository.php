<?php declare(strict_types=1);

namespace App\Repositories\Section;

use App\Core\Database;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;
use PDOException;

class PdoSectionRepository
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
                ->select('*')
                ->from('sections')
                ->fetchAllAssociative();
        } catch (PDOException|Exception) {
            return null;
        }
    }
}