<?php

namespace GeTracker\OsrsApi\DTO\Hiscore;

class ClueScrollCollection extends AbstractRankScoreDataCollection
{
    /** @var \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData */
    public $all;

    /** @var \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData */
    public $easy;

    /** @var \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData */
    public $medium;

    /** @var \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData */
    public $hard;

    /** @var \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData */
    public $elite;

    /** @var \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData */
    public $master;
}
