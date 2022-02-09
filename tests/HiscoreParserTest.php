<?php

namespace GeTracker\OsrsApi\Tests;

use GeTracker\OsrsApi\Factory\AbstractRankScoreDataCollectionFactory;
use GeTracker\OsrsApi\Support\HiscoreParser;
use Orchestra\Testbench\TestCase;

class HiscoreParserTest extends TestCase
{
    protected string $rawStats;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rawStats = <<<'RAW'
168085,1852,119469812
113635,99,13217770
177825,92,7131488
202412,99,13086064
112488,99,18790372
96351,99,16831751
112050,82,2431409
169422,96,10046520
814677,66,532730
114934,87,4214713
642514,66,531453
710808,64,436733
550062,66,532493
186969,77,1548801
368360,70,763058
482283,68,623227
68999,90,5346944
657780,60,300220
298839,70,737879
150711,90,5609955
55032,99,13082219
235601,61,302387
332175,69,669239
119109,83,2702387
-1,-1
-1,-1
-1,-1
566254,12
-1,-1
681388,2
406888,6
417933,4
-1,-1
-1,-1
-1,-1
11773,522
-1,-1
167363,66
-1,-1
-1,-1
-1,-1
59845,34
-1,-1
46001,11
-1,-1
-1,-1
57115,16
74359,17
51019,174
63418,200
49937,183
-1,-1
66750,111
109554,9
37587,64
-1,-1
-1,-1
140259,53
100500,454
89335,2
82913,6
-1,-1
-1,-1
-1,-1
21053,53
108052,10
-1,-1
-1,-1
-1,-1
-1,-1
-1,-1
13740,17
47578,29
44939,4
69357,211
288122,28
-1,-1
79911,234

RAW;
    }

    /** @test */
    public function can_parse_hiscores(): void
    {
        $parser = new HiscoreParser(new AbstractRankScoreDataCollectionFactory());
        $hiscores = $parser->parse('Zezima', $this->rawStats);

        self::assertSame('Zezima', $hiscores->rsn);
        self::assertSame(99, $hiscores->stats->attack->level);
        self::assertSame(99, $hiscores->stats->strength->level);
        self::assertNull($hiscores->bountyHunter->hunter->rank);
        self::assertNotNull($hiscores->clueScroll->easy->score);
    }

    /** @test */
    public function return_nulled_object_on_not_found(): void
    {
        $parser = new HiscoreParser(new AbstractRankScoreDataCollectionFactory());
        $hiscores = $parser->parse('oaisdjoaisdjoaisjd', null);

        self::assertSame('oaisdjoaisdjoaisjd', $hiscores->rsn);
        self::assertNull($hiscores->stats);
        self::assertNull($hiscores->bountyHunter);
        self::assertNull($hiscores->clueScroll);
        self::assertNull($hiscores->lastManStanding);
    }
}
