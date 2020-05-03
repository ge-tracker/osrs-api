<?php

namespace GeTracker\OsrsApi\DTO\Hiscore;

class ClueScrollCollection extends AbstractRankScoreDataCollection
{
    public RankScoreData $all;

    public RankScoreData $easy;

    public RankScoreData $medium;

    public RankScoreData $hard;

    public RankScoreData $elite;

    public RankScoreData $master;
}
