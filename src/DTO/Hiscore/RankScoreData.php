<?php

namespace GeTracker\OsrsApi\DTO\Hiscore;

use Spatie\DataTransferObject\DataTransferObject;

class RankScoreData extends DataTransferObject
{
    public ?int $rank = null;

    public ?int $score = null;
}
