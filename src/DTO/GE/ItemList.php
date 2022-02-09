<?php

namespace GeTracker\OsrsApi\DTO\GE;

use Spatie\DataTransferObject\DataTransferObject;

class ItemList extends DataTransferObject
{
    /** @var \GeTracker\OsrsApi\DTO\GE\ItemDetail[] */
    public array $items;

    public static function fromJson($data): self
    {
        return new self([
            'items' => array_map(static fn ($item) => ItemDetail::fromJson($item), $data->items),
        ]);
    }
}
