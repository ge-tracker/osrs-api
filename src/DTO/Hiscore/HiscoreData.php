<?php

namespace GeTracker\OsrsApi\DTO\Hiscore;

use Spatie\DataTransferObject\DataTransferObject;

class HiscoreData extends DataTransferObject
{
    /** @var string */
    public $rsn;

    /** @var \GeTracker\OsrsApi\DTO\Hiscore\HiscoreStatDataCollection|null */
    public $stats;

    /** @var \GeTracker\OsrsApi\DTO\Hiscore\BountyHunterCollection|null */
    public $bountyHunter;

    /** @var \GeTracker\OsrsApi\DTO\Hiscore\ClueScrollCollection|null */
    public $clueScroll;

    /** @var \GeTracker\OsrsApi\DTO\Hiscore\LastManStandingCollection|null */
    public $lastManStanding;
}
