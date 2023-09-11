<?php declare(strict_types=1);

namespace App\Repositories\Listing;

use App\Core\Database;
use App\Services\Listing\Create\CreateListingRequest;
use App\Services\Listing\Delete\DeleteListingRequest;
use App\Services\Listing\Read\ReadListingRequest;
use App\Services\Listing\Update\UpdateListingRequest;
use Carbon\Carbon;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;
use PDOException;

class PdoListingRepository
{
    private QueryBuilder $query;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->query = Database::connect();
    }

    public function create(CreateListingRequest $listing): string
    {
        try {
            $this->query
                ->insert('listing')
                ->values(
                    [
                        'option_id' => '?',
                        'option_name' => '?',
                        'author' => '?',
                        'title' => '?',
                        'description' => '?',
                        'price' => '?',
                        'location' => '?',
                        'created_at' => '?',
                    ]
                )
                ->setParameter(0, $listing->optionId())
                ->setParameter(1, $listing->optionName())
                ->setParameter(2, $listing->author())
                ->setParameter(3, $listing->title())
                ->setParameter(4, $listing->description())
                ->setParameter(5, $listing->price())
                ->setParameter(6, $listing->location())
                ->setParameter(7, Carbon::now()->toDateTimeString())
                ->executeQuery();

            return "Listing created successfully!";
        } catch (PDOException|Exception) {
            return "Something went wrong while creating a listing!";
        }
    }

    public function read(ReadListingRequest $request): array|string
    {
        try {
            return $this->query
                ->select('l.*')
                ->from('listing', 'l')
                ->leftJoin('l', 'options', 'o', 'o.id = l.option_id')
                ->where('l.option_id = ?')
                ->setParameter(0, $request->id())
                ->fetchAllAssociative();
        } catch (PDOException|Exception) {
            return "Something went wrong! The operation didn't execute as expected. Please try again later or contact our support team for assistance";
        }
    }

    public function fetchAll(): array|string
    {
        try {
            return $this->query
                ->select('*')
                ->from('listing')
                ->fetchAllAssociative();
        } catch (PDOException|Exception) {
            return "Something went wrong! The operation didn't execute as expected. Please try again later or contact our support team for assistance";
        }
    }

    public function fetchSingle(ReadListingRequest $request): string|array
    {
        try {
            return $this->query
                ->select('*')
                ->from('listing')
                ->where('id = ?')
                ->setParameter(0, $request->id())
                ->fetchAssociative();
        } catch (PDOException|Exception) {
            return "Something went wrong! The operation didn't execute as expected. Please try again later or contact our support team for assistance";
        }
    }

    public function update(UpdateListingRequest $listing): string
    {
        try {
            $this->query
                ->update('listing')
                ->set('title', '?')
                ->set('description', '?')
                ->set('price', '?')
                ->set('location', '?')
                ->setParameter(0, $listing->title())
                ->setParameter(1, $listing->description())
                ->setParameter(2, $listing->price())
                ->setParameter(3, $listing->location())
                ->where('id = ' . $listing->id())
                ->executeQuery();

            return "Updated successfully :)";
        } catch (PDOException|Exception) {
            return "Something went wrong while updating a listing :(";
        }
    }

    public function delete(DeleteListingRequest $listing): string
    {
        try {
            $this->query
                ->delete('listing')
                ->where('id = ?')
                ->setParameter(0, $listing->id())
                ->executeQuery();

            return "Listing deleted successfully :)";
        } catch (PDOException|Exception) {
            return "Something went wrong while deleting a listing :(";
        }
    }
}