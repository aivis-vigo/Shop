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

    public function read(): array
    {
        try {
            return $this->query
                ->select('*')
                ->from('sections', 's')
                ->leftJoin('s', 'options', 'o', 's.id = o.section_id')
                ->fetchAllAssociative();

            // ->orderBy('title', 'ASC')
        } catch (PDOException|Exception) {
            return [];
        }
    }
}