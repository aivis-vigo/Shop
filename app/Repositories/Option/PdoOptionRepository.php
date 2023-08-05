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

    public function read(int $id): ?array
    {
        try {
            return $this->query
                ->select("o.id, o.title")
                ->from("options", "o")
                ->innerJoin("o", "sections", "s", "s.id = o.section_id")
                ->where("section_id = ?")
                ->setParameter(0, $id)
                ->fetchAllAssociative();
        } catch (PDOException|Exception) {
            return null;
        }
    }

    public function fetchAll(): ?array
    {
        try {
            return $this->query
                ->select("*")
                ->from("options")
                ->fetchAllAssociative();
        } catch (PDOException|Exception) {
            return null;
        }
    }
}