<?php

namespace GeTracker\OsrsApi\DTO\Hiscore;

class BountyHunterCollection extends AbstractRankScoreDataCollection
{
    /** @var \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData */
    public $hunter;

    /** @var \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData */
    public $rogue;
}
