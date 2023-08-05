<?php declare(strict_types=1);

namespace App\Repositories\Listing;

use App\Core\Database;
use App\Services\Listing\Create\CreateListingRequest;
use App\Services\Listing\Read\ReadListingRequest;
use App\Services\Listing\Read\ReadListingResponse;
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

    // TODO: convert price to int
    public function create(CreateListingRequest $listing): void
    {
        try {
            $this->query
                ->insert('listing')
                ->values(
                    [
                        'option_id' => '?',
                        'title' => '?',
                        'description' => '?',
                        'price' => '?',
                        'location' => '?',
                        'created_at' => '?',
                    ]
                )
                ->setParameter(0, $listing->optionId())
                ->setParameter(1, $listing->title())
                ->setParameter(2, $listing->description())
                ->setParameter(3, $listing->price())
                ->setParameter(4, $listing->location())
                ->setParameter(5, Carbon::now()->toDateTimeString())
                ->executeQuery();
        } catch (PDOException|Exception) {
            return;
        }
    }

    public function read(ReadListingRequest $request): ?array
    {
        try {
            return $this->query
                ->select('*')
                ->from('listing')
                ->where('option_id = ?')
                ->setParameter(0, $request->id())
                ->fetchAllAssociative();
        } catch (PDOException|Exception) {
            return null;
        }
    }
}