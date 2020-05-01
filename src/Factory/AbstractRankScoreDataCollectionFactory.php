<?php

namespace GeTracker\OsrsApi\Factory;

use GeTracker\OsrsApi\DTO\Hiscore\AbstractRankScoreDataCollection;
use GeTracker\OsrsApi\DTO\Hiscore\BountyHunterCollection;
use GeTracker\OsrsApi\DTO\Hiscore\ClueScrollCollection;
use GeTracker\OsrsApi\DTO\Hiscore\LastManStandingCollection;

class AbstractRankScoreDataCollectionFactory
{
    /**
     * Build an `AbstractRankScoreDataCollection` based on the supplied `section` of the hiscores
     *
     * @param string $section
     * @param array  $data
     *
     * @return AbstractRankScoreDataCollection
     */
    public function make(string $section, array $data): AbstractRankScoreDataCollection
    {
        switch ($section) {
            case 'bountyHunter':
                return $this->createBountyHunterCollection($data);
            case 'clueScroll':
                return $this->createClueScrollCollection($data);
            case 'lastManStanding':
                return $this->createLastManStandingCollection($data);
            default:
                throw new \RuntimeException('Unrecognised `$section` supplied to factory');
        }
    }

    public function createBountyHunterCollection(array $data): BountyHunterCollection
    {
        return new BountyHunterCollection($data);
    }

    public function createClueScrollCollection(array $data): ClueScrollCollection
    {
        return new ClueScrollCollection($data);
    }

    public function createLastManStandingCollection(array $data): LastManStandingCollection
    {
        return new LastManStandingCollection($data);
    }
}
