<?php

namespace GeTracker\OsrsApi\API;

use GeTracker\OsrsApi\DTO\GE\AlphaList;
use GeTracker\OsrsApi\DTO\GE\ItemDetail;
use GeTracker\OsrsApi\DTO\GE\ItemList;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class GeApi
{
    private const ITEM_DETAIL = 'https://secure.runescape.com/m=itemdb_oldschool/api/catalogue/detail.json?item=';
    private const ALPHAS = 'https://secure.runescape.com/m=itemdb_oldschool/api/catalogue/category.json?category=1';
    private const ALPHA_PAGE = 'https://secure.runescape.com/m=itemdb_oldschool/api/catalogue/items.json';

    private bool $waitForResponse = false;

    /**
     * Get details about an Item
     *
     * @param int $itemId
     *
     * @return ItemDetail|null
     */
    public function itemDetail(int $itemId): ?ItemDetail
    {
        $request = Http::get(static::ITEM_DETAIL . $itemId);

        if ($this->shouldRetry($request)) {
            sleep(3);
            return $this->itemDetail($itemId);
        }

        return $request->successful()
            ? ItemDetail::fromJson($request->object())
            : null;
    }

    private function shouldRetry(Response $response): bool
    {
        return $this->waitForResponse &&
            $response->successful() &&
            $response->object() === null;
    }

    /**
     * List the first letter of every item, and get the count of each
     *
     * @return AlphaList|null
     */
    public function listAlphas(): ?AlphaList
    {
        $request = Http::get(static::ALPHAS);

        return $request->successful()
            ? AlphaList::fromJson($request->object())
            : null;
    }

    /**
     * Get a list of items in each alpha
     *
     * @param string $alpha
     * @param int    $page
     *
     * @return AlphaList|null
     * @see GeApi::listAlphas()
     */
    public function alpha(string $alpha, int $page = 1): ?ItemList
    {
        if ($alpha === 'numeric') {
            $alpha = '#';
        }

        $request = Http::get(static::ALPHA_PAGE, [
            'category' => 1,
            'alpha'    => $alpha,
            'page'     => $page,
        ]);

        return $request->successful()
            ? ItemList::fromJson($request->object())
            : null;
    }

    public function wait(): self
    {
        $this->waitForResponse = true;
        return $this;
    }
}
