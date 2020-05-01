<?php

namespace GeTracker\OsrsApi\Support;

use GeTracker\OsrsApi\DTO\Hiscore\AbstractRankScoreDataCollection;
use GeTracker\OsrsApi\DTO\Hiscore\HiscoreData;
use GeTracker\OsrsApi\DTO\Hiscore\HiscoreStatData;
use GeTracker\OsrsApi\DTO\Hiscore\HiscoreStatDataCollection;
use GeTracker\OsrsApi\DTO\Hiscore\RankScoreData;
use GeTracker\OsrsApi\Factory\AbstractRankScoreDataCollectionFactory;

class HiscoreParser
{
    /**
     * This mapping denotes which array index should be used for which value
     *
     * @var array
     */
    private $mapping = [
        'stats'           => [
            'overall'      => 0,
            'attack'       => 1,
            'defence'      => 2,
            'strength'     => 3,
            'hitpoints'    => 4,
            'ranged'       => 5,
            'prayer'       => 6,
            'magic'        => 7,
            'cooking'      => 8,
            'woodcutting'  => 9,
            'fletching'    => 10,
            'fishing'      => 11,
            'firemaking'   => 12,
            'crafting'     => 13,
            'smithing'     => 14,
            'mining'       => 15,
            'herblore'     => 16,
            'agility'      => 17,
            'thieving'     => 18,
            'slayer'       => 19,
            'farming'      => 20,
            'runecraft'    => 21,
            'hunter'       => 22,
            'construction' => 23,
        ],
        'bountyHunter'    => [
            'hunter' => 24,
            'rogue'  => 25,
        ],
        'clueScroll'      => [
            'all'    => 26,
            'easy'   => 27,
            'medium' => 28,
            'hard'   => 29,
            'elite'  => 30,
            'master' => 31,
        ],
        'lastManStanding' => [
            'ranked' => 32,
        ],
    ];

    private $raw = [];

    private $rankScoreDataCollectionFactory;

    public function __construct(AbstractRankScoreDataCollectionFactory $rankScoreDataCollectionFactory)
    {
        $this->rankScoreDataCollectionFactory = $rankScoreDataCollectionFactory;
    }

    /**
     * Parse the raw string fetched from OSRS Hiscores into a `HiscoreData` object
     *
     * @param string      $username
     * @param string|null $raw
     *
     * @return HiscoreData
     */
    public function parse(string $username, ?string $raw): HiscoreData
    {
        if ($raw === null) {
            return $this->notFound($username);
        }

        // Split the raw string by newline
        $this->raw = explode("\n", $raw);

        return new HiscoreData([
            'rsn'             => $username,
            'stats'           => $this->parseStats(),
            'bountyHunter'    => $this->parseRanked('bountyHunter'),
            'clueScroll'      => $this->parseRanked('clueScroll'),
            'lastManStanding' => $this->parseRanked('lastManStanding'),
        ]);
    }

    /**
     * Return a nulled object
     *
     * @param string $username
     *
     * @return HiscoreData
     */
    private function notFound(string $username): HiscoreData
    {
        return new HiscoreData([
            'rsn'             => $username,
            'stats'           => null,
            'bountyHunter'    => null,
            'clueScroll'      => null,
            'lastManStanding' => null,
        ]);
    }

    /**
     * Parse generic stats (i.e. attack, strength)
     *
     * @return HiscoreStatDataCollection
     */
    private function parseStats(): HiscoreStatDataCollection
    {
        $stats = [];

        foreach ($this->mapping['stats'] as $skill => $idx) {
            [$rank, $level, $exp] = explode(',', trim($this->raw[$idx]));

            $stats[$skill] = new HiscoreStatData([
                'rank'  => $this->showNull($rank),
                'level' => (int)$level,
                'exp'   => $this->showNull($exp),
            ]);
        }

        return new HiscoreStatDataCollection($stats);
    }

    /**
     * Parse ranked stats (i.e. bountyHunter)
     *
     * @param string $section
     *
     * @return AbstractRankScoreDataCollection
     */
    private function parseRanked(string $section): AbstractRankScoreDataCollection
    {
        $stats = [];

        foreach ($this->mapping[$section] as $skill => $idx) {
            [$rank, $score] = explode(',', trim($this->raw[$idx]));

            $stats[$skill] = new RankScoreData([
                'rank'  => $this->showNull($rank),
                'score' => $this->showNull($score),
            ]);
        }

        return $this->rankScoreDataCollectionFactory->make($section, $stats);
    }

    /**
     * Return null instead of a -1
     *
     * @param string $stat
     *
     * @return int|null
     */
    private function showNull(string $stat): ?int
    {
        return ($stat === '-1') ? null : (int)$stat;
    }
}
