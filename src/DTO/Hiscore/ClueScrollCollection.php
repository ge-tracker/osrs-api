<?php

namespace GeTracker\OsrsApi\DTO\Hiscore;

class ClueScrollCollection extends AbstractRankScoreDataCollection
{
    public \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData $all;

    public \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData $easy;

    public \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData $medium;

    public \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData $hard;

    public \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData $elite;

    public \GeTracker\OsrsApi\DTO\Hiscore\RankScoreData $master;
}
