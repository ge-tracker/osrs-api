<?php

namespace GeTracker\OsrsApi\Contracts;

interface FetchHiscoresAction
{
    /**
     * Fetch the hiscores for `username` and return a formatted `HiscoreData` object
     *
     * @param string $username
     *
     * @return \GeTracker\OsrsApi\DTO\Hiscore\HiscoreData
     */
    public function fetch(string $username): \GeTracker\OsrsApi\DTO\Hiscore\HiscoreData;
}
