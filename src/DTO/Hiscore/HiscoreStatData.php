<?php

namespace GeTracker\OsrsApi\DTO\Hiscore;

use Spatie\DataTransferObject\DataTransferObject;

class HiscoreStatData extends DataTransferObject
{
    public ?int $rank = null;

    public ?int $level = null;

    public ?int $exp = null;
}
