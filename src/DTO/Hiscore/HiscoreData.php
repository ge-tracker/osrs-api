<?php

namespace GeTracker\OsrsApi\DTO\Hiscore;

use Spatie\DataTransferObject\DataTransferObject;

class HiscoreData extends DataTransferObject
{
    public string $rsn;

    public ?HiscoreStatDataCollection $stats = null;

    public ?BountyHunterCollection $bountyHunter = null;

    public ?ClueScrollCollection $clueScroll = null;

    public ?LastManStandingCollection $lastManStanding = null;
}
