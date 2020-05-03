<?php

namespace GeTracker\OsrsApi\DTO\Hiscore;

use Spatie\DataTransferObject\DataTransferObject;

class HiscoreStatDataCollection extends DataTransferObject
{
    public HiscoreStatData $overall;

    public HiscoreStatData $attack;

    public HiscoreStatData $defence;

    public HiscoreStatData $strength;

    public HiscoreStatData $hitpoints;

    public HiscoreStatData $ranged;

    public HiscoreStatData $prayer;

    public HiscoreStatData $magic;

    public HiscoreStatData $cooking;

    public HiscoreStatData $woodcutting;

    public HiscoreStatData $fletching;

    public HiscoreStatData $fishing;

    public HiscoreStatData $firemaking;

    public HiscoreStatData $crafting;

    public HiscoreStatData $smithing;

    public HiscoreStatData $mining;

    public HiscoreStatData $herblore;

    public HiscoreStatData $agility;

    public HiscoreStatData $thieving;

    public HiscoreStatData $slayer;

    public HiscoreStatData $farming;

    public HiscoreStatData $runecraft;

    public HiscoreStatData $hunter;

    public HiscoreStatData $construction;
}
