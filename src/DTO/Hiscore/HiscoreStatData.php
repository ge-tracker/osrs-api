<?php

namespace GeTracker\OsrsApi\DTO\Hiscore;

use Spatie\DataTransferObject\DataTransferObject;

class HiscoreStatData extends DataTransferObject
{
    /** @var int|null */
    public $rank;

    /** @var int|null */
    public $level;

    /** @var int|null */
    public $exp;
}
