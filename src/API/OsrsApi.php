<?php

namespace GeTracker\OsrsApi\API;

/**
 * @method GeApi ge()
 */
class OsrsApi
{
    /** @var GeApi */
    private $geApi;

    public function __construct(GeApi $geApi)
    {
        $this->geApi = $geApi;
    }

    public function __call($name, $arguments)
    {
        if ($name === 'ge') {
            return $this->geApi;
        }
    }
}
