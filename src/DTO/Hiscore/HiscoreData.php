<?php

namespace GeTracker\OsrsApi\DTO\Hiscore;

use Spatie\DataTransferObject\DataTransferObject;

class HiscoreData extends DataTransferObject
{
    public string $rsn;

    public ?\GeTracker\OsrsApi\DTO\Hiscore\HiscoreStatDataCollection $stats = null;

    public ?\GeTracker\OsrsApi\DTO\Hiscore\BountyHunterCollection $bountyHunter = null;

    public ?\GeTracker\OsrsApi\DTO\Hiscore\ClueScrollCollection $clueScroll = null;

    public ?\GeTracker\OsrsApi\DTO\Hiscore\LastManStandingCollection $lastManStanding = null;
}
