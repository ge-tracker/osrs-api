<?php

namespace GeTracker\OsrsApi\Tests;

use GeTracker\OsrsApi\API\OsrsApi;
use GeTracker\OsrsApi\OsrsApiServiceProvider;
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

        $this->assertSame(13576, $detail->id);
        $this->assertSame('Dragon warhammer', $detail->name);
    }

    /** @test */
    public function can_get_alpha_categories(): void
    {
        $alphas = $this->osrsApi->ge()->listAlphas();

        $this->assertGreaterThan(500, $alphas->totalItems);
        $this->assertGreaterThan(5, $alphas->alphas['numeric']);
        $this->assertGreaterThan(200, $alphas->alphas['a']);
        $this->assertGreaterThan(200, $alphas->alphas['s']);
    }

    /** @test */
    public function can_get_alpha_a(): void
    {
        $alphas = $this->osrsApi->ge()->alpha('a');

        $this->assertSame(10392, $alphas->items[0]->id);
        $this->assertSame('A powdered wig', $alphas->items[0]->name);
    }

    /** @test */
    public function can_load_hiscores(): void
    {
        $hiscores = $this->osrsApi->hiscores()->fetch('Lynx Titan');

        $this->assertSame('Lynx Titan', $hiscores->rsn);
        $this->assertSame(99, $hiscores->stats->attack->level);
        $this->assertSame(99, $hiscores->stats->strength->level);
        $this->assertNull($hiscores->bountyHunter->hunter->rank);
        $this->assertNotNull($hiscores->clueScroll->easy->score);
    }
}
