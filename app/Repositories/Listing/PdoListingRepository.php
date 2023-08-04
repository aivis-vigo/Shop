<?php declare(strict_types=1);

namespace App\Repositories\Listing;

use App\Core\Database;
use App\Services\Listing\CreateListingRequest;
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

    public function create(CreateListingRequest $listing): void
    {
        try {
            $this->query
                ->insert('listing')
                ->values(
                    [
                        'option_id => ?',
                        'title => ?',
                        'description => ?',
                        'created_at => ?',
                    ]
                )
                ->setParameter(0, $listing->optionId())
                ->setParameter(1, $listing->title())
                ->setParameter(2, $listing->description())
                ->setParameter(3, Carbon::now()->toDateTimeString())
                ->executeQuery();
        } catch (PDOException|Exception) {
            return;
        }
    }
}