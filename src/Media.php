<?php
namespace Apsg\Wordpressor;

use Apsg\Wordpressor\DTO\Medium;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use stdClass;

class Media
{
    const CACHE_PREFIX = '_media';

    protected string $url;
    protected bool $shouldCache;

    public function __construct(string $url, bool $shouldCache = true)
    {
        $this->url = $url . '/media/';
        $this->shouldCache = $shouldCache;
    }

    public function get(int $id) : stdClass
    {
        if ($this->shouldCache) {
            return Cache::tags([CacheHelper::PREFIX])
                ->remember(CacheHelper::PREFIX . static::CACHE_PREFIX . $id,
                    CacheHelper::TTL,
                    function () use ($id) {
                        return $this->getRaw($id);
                    });
        }

        return $this->getRaw($id);
    }

    protected function getRaw(int $id) : stdClass
    {
        $client = new Client();

        return json_decode($client->get($this->url . $id)
            ->getBody()
            ->getContents());
    }

    public function getTransformed(int $id) : Medium
    {
        return new Medium($this->get($id));
    }
}
