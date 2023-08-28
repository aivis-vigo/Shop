<?php declare(strict_types=1);

namespace App\Repositories\Option;

use App\Core\Database;
use App\Services\Option\Create\CreateOptionRequest;
use App\Services\Option\Delete\DeleteOptionRequest;
use App\Services\Option\Read\ReadOptionsRequest;
use App\Services\Option\Update\UpdateOptionRequest;
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

    public function create(CreateOptionRequest $option): string
    {
        try {
            $this->query
                ->insert('options')
                ->values(
                    [
                        "section_id" => "?",
                        "title" => "?"
                    ]
                )
                ->setParameter(0, $option->sectionId())
                ->setParameter(1, $option->title())
                ->executeQuery();

            return "Option created successfully :)";
        } catch (PDOException|Exception) {
            return "Something went wrong while creating an option :(";
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

    public function update(UpdateOptionRequest $option): string
    {
        try {
            $this->query
                ->update('options')
                ->set('title', '?')
                ->set('cover_url', '?')
                ->setParameter(1, $option->title())
                ->setParameter(2, $option->pictureUrl())
                ->where('id = ' . $option->id())
                ->executeQuery();

            return "Option updated successfully :)";
        } catch (PDOException|Exception) {
            return "Something went wrong while updating option :(";
        }
    }

    public function delete(DeleteOptionRequest $option): string
    {
        try {
            $this->query
                ->delete('options')
                ->where('id = ?')
                ->setParameter(0, $option->id())
                ->executeQuery();

            return "Option deleted successfully :)";
        } catch (PDOException|Exception) {
            return "Something went wrong while deleting option :(";
        }
    }
}