<?php

namespace GeTracker\OsrsApi\Tests;

use GeTracker\OsrsApi\Actions\FetchHiscoresAction;
use GeTracker\OsrsApi\Support\HiscoreParser;
use Orchestra\Testbench\TestCase;

class FetchHiscoresActionTest extends TestCase
{
    /** @test */
    public function can_load_hiscores()
    {
        $action = new FetchHiscoresAction(app(HiscoreParser::class));
        $hiscores = $action->fetch('lynx_titan');

        $this->assertSame('Lynx Titan', $hiscores->rsn);
        $this->assertSame(99, $hiscores->stats->attack->level);
        $this->assertSame(99, $hiscores->stats->strength->level);
        $this->assertNull($hiscores->bountyHunter->hunter->rank);
        $this->assertNotNull($hiscores->clueScroll->easy->score);
    }
}
