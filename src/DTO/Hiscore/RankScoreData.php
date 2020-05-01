<?php

namespace GeTracker\OsrsApi\DTO\Hiscore;

use Spatie\DataTransferObject\DataTransferObject;

class RankScoreData extends DataTransferObject
{
    /** @var int|null */
    public $rank;

    /** @var int|null */
    public $score;
}
