<?php declare(strict_types=1);

namespace App\Repositories\Section;

use App\Core\Database;
use App\Services\Section\Create\CreateSectionRequest;
use App\Services\Section\Delete\DeleteSectionRequest;
use App\Services\Section\Update\UpdateSectionRequest;
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
        } catch (PDOException|Exception) {
            return [];
        }
    }

    public function withoutOptions(): array
    {
        try {
            return $this->query
                ->select('*')
                ->from('sections')
                ->orderBy('title', 'ASC')
                ->fetchAllAssociative();
        } catch (PDOException|Exception) {
            return [];
        }
    }

    public function disableDelete(): array
    {
        try {
            return $this->query
                ->select('*')
                ->from('sections', 's')
                ->join('s', 'options', 'o', 's.id = o.section_id')
                ->join('o', 'listing', 'l', 'o.id = l.option_id')
                ->fetchAllAssociative();
        } catch (PDOException|Exception) {
            return [];
        }
    }

    public function create(CreateSectionRequest $section): string
    {
        try {
            $this->query
                ->insert('sections')
                ->values([
                    'title' => '?',
                    'section' => '?',
                    'description' => '?',
                    'picture_url' => '?'
                ])
                ->setParameter(0, $section->title())
                ->setParameter(1, $section->title())
                ->setParameter(2, $section->description())
                ->setParameter(3, $section->pictureUrl())
                ->executeQuery();

            return "Created successfully :)";
        } catch (PDOException|Exception) {
            return "Something went wrong creating new section :(";
        }
    }

    public function update(UpdateSectionRequest $section): string
    {
        try {
            $this->query
                ->update('sections')
                ->set('title', '?')
                ->set('section', '?')
                ->set('description', '?')
                ->set('picture_url', '?')
                ->setParameter(0, $section->title())
                ->setParameter(1, $section->title())
                ->setParameter(2, $section->description())
                ->setParameter(3, $section->pictureUrl())
                ->where('id = ' . $section->id())
                ->executeQuery();

            return "Created successfully :)";
        } catch (PDOException|\Exception) {
            return "Something went wrong updating section :(";
        }
    }

    public function delete(DeleteSectionRequest $section): string
    {
        try {
            $this->query
                ->delete('sections')
                ->where('id = ?')
                ->setParameter(0, $section->id())
                ->executeQuery();

            return "Section deleted successfully :)";
        } catch (PDOException|Exception) {
            return "Something went wrong while deleting section :(";
        }
    }
}