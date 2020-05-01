<?php

namespace GeTracker\OsrsApi\DTO\GE;

use Spatie\DataTransferObject\DataTransferObject;

class AlphaList extends DataTransferObject
{
    public array $alphas;

    public int $totalItems;

    public static function fromJson($data): AlphaList
    {
        [$alphas, $total] = self::fromAlphas($data->alpha);

        return new self([
            'alphas'     => $alphas,
            'totalItems' => $total,
        ]);
    }

    private static function fromAlphas($data): array
    {
        $alphas = [];
        $total = 0;

        foreach ($data as $datum) {
            $key = $datum->letter === '#' ? 'numeric' : $datum->letter;
            $total += $datum->items;
            $alphas[$key] = $datum->items;
        }

        return [$alphas, $total];
    }
}
