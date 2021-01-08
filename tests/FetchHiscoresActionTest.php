<?php

namespace GeTracker\OsrsApi\Tests;

use GeTracker\OsrsApi\Actions\FetchHiscoresAction;
use GeTracker\OsrsApi\Support\HiscoreParser;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase;

class FetchHiscoresActionTest extends TestCase
{
    /** @test */
    public function can_load_hiscores(): void
    {
        Http::fake([
            'secure.runescape.com/*' => Http::response(file_get_contents(base_path('../../../../tests/Stubs/hiscore.success.txt'))),
        ]);

        $action = new FetchHiscoresAction(app(HiscoreParser::class));
        $hiscores = $action->fetch('lynx_titan');

        self::assertSame('Lynx Titan', $hiscores->rsn);
        self::assertSame(99, $hiscores->stats->attack->level);
        self::assertSame(99, $hiscores->stats->strength->level);
        self::assertNull($hiscores->bountyHunter->hunter->rank);
        self::assertNotNull($hiscores->clueScroll->easy->score);
    }

    /** @test */
    public function returns_null_on_failed(): void
    {
        Http::fake([
            'secure.runescape.com/*' => Http::response(null, 500),
        ]);

        $action = new FetchHiscoresAction(app(HiscoreParser::class));
        $hiscores = $action->fetch('lynx_titan');

        self::assertNull($hiscores->stats);
    }

    /** @test */
    public function returns_null_on_jagex_fail(): void
    {
        Http::fake([
            'secure.runescape.com/*' => Http::response(file_get_contents(base_path('../../../../tests/Stubs/hiscore.offline.txt'))),
        ]);

        $action = new FetchHiscoresAction(app(HiscoreParser::class));
        $hiscores = $action->fetch('lynx_titan');

        self::assertNull($hiscores->stats);
    }
}
