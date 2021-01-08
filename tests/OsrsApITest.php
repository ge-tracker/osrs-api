<?php

namespace GeTracker\OsrsApi\Tests;

use GeTracker\OsrsApi\API\OsrsApi;
use GeTracker\OsrsApi\OsrsApiServiceProvider;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase;

class OsrsApITest extends TestCase
{
    /** @var OsrsApi */
    private $osrsApi;

    protected function setUp(): void
    {
        parent::setUp();

        $this->osrsApi = $this->app->make(OsrsApi::class);
    }

    protected function getPackageProviders($app): array
    {
        return [OsrsApiServiceProvider::class];
    }

    /** @test */
    public function can_get_item_details(): void
    {
        $detail = $this->osrsApi->ge()->itemDetail(13576);

        self::assertSame(13576, $detail->id);
        self::assertSame('Dragon warhammer', $detail->name);
    }

    /** @test */
    public function can_get_item_details_and_wait(): void
    {
        $detail = $this->osrsApi->ge()->wait()->itemDetail(13576);

        self::assertSame(13576, $detail->id);
        self::assertSame('Dragon warhammer', $detail->name);
    }

    /** @test */
    public function can_get_alpha_categories(): void
    {
        $alphas = $this->osrsApi->ge()->listAlphas();

        self::assertGreaterThan(500, $alphas->totalItems);
        self::assertGreaterThan(5, $alphas->alphas['numeric']);
        self::assertGreaterThan(200, $alphas->alphas['a']);
        self::assertGreaterThan(200, $alphas->alphas['s']);
    }

    /** @test */
    public function can_get_alpha_a(): void
    {
        $alphas = $this->osrsApi->ge()->alpha('a');

        self::assertSame(10392, $alphas->items[0]->id);
        self::assertSame('A powdered wig', $alphas->items[0]->name);
    }

    /** @test */
    public function can_load_hiscores(): void
    {
        Http::fake([
            'secure.runescape.com/*' => Http::response(file_get_contents(base_path('../../../../tests/Stubs/hiscore.success.txt'))),
        ]);

        $hiscores = $this->osrsApi->hiscores()->fetch('Lynx Titan');

        self::assertSame('Lynx Titan', $hiscores->rsn);
        self::assertSame(99, $hiscores->stats->attack->level);
        self::assertSame(99, $hiscores->stats->strength->level);
        self::assertNull($hiscores->bountyHunter->hunter->rank);
        self::assertNotNull($hiscores->clueScroll->easy->score);
    }
}
