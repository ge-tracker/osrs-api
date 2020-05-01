<?php

namespace GeTracker\OsrsApi;

use GeTracker\OsrsApi\Actions\CachableFetchHiscoresAction;
use GeTracker\OsrsApi\Actions\FetchHiscoresAction;
use GeTracker\OsrsApi\Contracts\FetchHiscoresAction as FetchHiscoresActionContract;
use GeTracker\OsrsApi\Support\HiscoreParser;
use Illuminate\Support\ServiceProvider;

class OsrsApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('osrs-api.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'osrs-api');

        $this->app->bind(FetchHiscoresActionContract::class, function ($app) {
            $fetchHiscoresAction = new FetchHiscoresAction(
                app(HiscoreParser::class)
            );

            if (config('osrs-api.hiscores.cache') === null) {
                return $fetchHiscoresAction;
            }

            return new CachableFetchHiscoresAction($fetchHiscoresAction);
        });
    }
}
