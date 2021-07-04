<?php

namespace GeTracker\OsrsApi\DTO\GE;

use Spatie\DataTransferObject\DataTransferObject;

class ItemDetail extends DataTransferObject
{
    public int $id;
    public string $name;
    public string $icon;
    public string $iconLarge;
    public string $type;
    public string $typeIcon;
    public string $description;
    public bool $members;

    public static function fromJson($data): ItemDetail
    {
        if (is_object($data) && property_exists($data, 'item')) {
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
            'members'     => $data->members === 'true',
        ]);
    }
}
