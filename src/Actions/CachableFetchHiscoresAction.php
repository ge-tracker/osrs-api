<?php

namespace GeTracker\OsrsApi\Actions;

use GeTracker\OsrsApi\DTO\Hiscore\HiscoreData;
use Illuminate\Support\Facades\Cache;

class CachableFetchHiscoresAction implements \GeTracker\OsrsApi\Contracts\FetchHiscoresAction
{
    private \GeTracker\OsrsApi\Actions\FetchHiscoresAction $fetchHiscoresAction;

    public function __construct(FetchHiscoresAction $fetchHiscoresAction)
    {
        $this->fetchHiscoresAction = $fetchHiscoresAction;
    }

    /**
     * @inheritDoc
     */
    public function fetch(string $username): \GeTracker\OsrsApi\DTO\Hiscore\HiscoreData
    {
        $cacheKey = 'highscores-' . sha1($this->fetchHiscoresAction->formatRsn($username));
        $cacheTime = now()->addSeconds(config('osrs-api.hiscores.cache'));

        /** @var HiscoreData $hiscores */
        $hiscores = Cache::remember($cacheKey, $cacheTime, fn() => $this->fetchHiscoresAction->fetch($username));

        return $hiscores;
    }
}
