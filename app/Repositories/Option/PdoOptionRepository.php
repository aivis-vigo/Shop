<?php declare(strict_types=1);

namespace App\Repositories\Option;

use App\Core\Database;
use App\Services\Option\Read\ReadOptionsRequest;
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

    public function read(int $id): array
    {
        try {
            return $this->query
                ->select("*, o.title, o.id")
                ->from("options", "o")
                ->leftJoin("o", "listing", "l", "o.id = l.option_id")
                ->where("section_id = ?")
                ->setParameter(0, $id)
                ->fetchAllAssociative();
        } catch (PDOException|Exception) {
            return [];
        }
    }

    public function fetchAll(): array
    {
        try {
            return $this->query
                ->select("*")
                ->from("options")
                ->fetchAllAssociative();
        } catch (PDOException|Exception) {
            return [];
        }
    }

    public function edit(ReadOptionsRequest $option): array
    {
        try {
            return $this->query
                ->select("*")
                ->from("options", "o")
                ->where('section_id = ?')
                ->setParameter(0, $option->id())
                ->fetchAllAssociative();
        } catch (PDOException|Exception) {
            return [];
        }
    }
}