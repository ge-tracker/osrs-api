<?php

namespace GeTracker\OsrsApi\DTO\GE;

use Spatie\DataTransferObject\DataTransferObject;

class ItemDetail extends DataTransferObject
{
    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $icon;

    /** @var string */
    public $iconLarge;

    /** @var string */
    public $type;

    /** @var string */
    public $typeIcon;

    /** @var string */
    public $description;

    public static function fromJson($data): ItemDetail
    {
        if (property_exists($data, 'item')) {
            $data = $data->item;
        }

        return new self([
            'id'          => $data->id ?? null,
            'name'        => $data->name ?? null,
            'icon'        => $data->icon ?? null,
            'iconLarge'   => $data->icon_large ?? null,
            'type'        => $data->type ?? null,
            'typeIcon'    => $data->typeIcon ?? null,
            'description' => $data->description ?? null,
        ]);
    }
}
