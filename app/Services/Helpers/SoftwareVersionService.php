<?php

namespace Pterodactyl\Services\Helpers;

use Exception;
use GuzzleHttp\Client;
use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Pterodactyl\Exceptions\Service\Helper\CdnVersionFetchingException;

class SoftwareVersionService
{
    public const VERSION_CACHE_KEY = 'pterodactyl:versioning_data';

    private static array $result;

    public function __construct(
        protected CacheRepository $cache,
        protected Client $client
    ) {
        self::$result = $this->cacheVersionData();
    }

    public function getPanel(): string
    {
        // Return a valid semantic version fallback instead of 'error'
        return Arr::get(self::$result, 'panel') ?: '0.0.0';
    }

    public function getDaemon(): string
    {
        return 'n/a'; // Not applicable when using GitHub only
    }

    public function getDiscord(): string
    {
        return 'https://discord.xample.dev';
    }

    public function getDonations(): string
    {
        return 'https://github.com/sponsors/xampledev';
    }

    public function isLatestPanel(): bool
    {
        if (config('app.version') === 'canary') {
            return true;
        }

        return version_compare(config('app.version'), $this->getPanel()) >= 0;
    }

    public function isLatestDaemon(string $version): bool
    {
        return true; // No wings check using GitHub
    }

    /**
     * Force refresh the cached version data.
     */
    public function refreshCache(): void
    {
        $this->cache->forget(self::VERSION_CACHE_KEY);
        self::$result = $this->cacheVersionData();
    }

    protected function cacheVersionData(): array
    {
        return $this->cache->remember(
            self::VERSION_CACHE_KEY,
            CarbonImmutable::now()->addMinutes(60),
            function () {
                try {
                    $response = $this->client->request('GET', 'https://api.github.com/repos/X-AmpleDevelopment/panel/releases/latest', [
                        'headers' => [
                            'Accept' => 'application/vnd.github.v3+json',
                            'User-Agent' => 'X-AmpleDevelopment-Panel-Updater',
                        ],
                    ]);

                    if ($response->getStatusCode() !== 200) {
                        throw new CdnVersionFetchingException('GitHub responded with ' . $response->getStatusCode());
                    }

                    $data = json_decode($response->getBody(), true);

                    if (!isset($data['tag_name'])) {
                        throw new CdnVersionFetchingException('Missing tag_name in GitHub release data.');
                    }

                    return [
                        'panel' => ltrim($data['tag_name'], 'v'),
                    ];
                } catch (Exception $ex) {
                    \Log::error('GitHub version check failed: ' . $ex->getMessage(), ['exception' => $ex]);
                    return [];
                }
            }
        );
    }
}
