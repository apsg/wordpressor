<?php
namespace Apsg\Wordpressor;

use Apsg\Wordpressor\DTO\Post;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

/**
 * @see https://developer.wordpress.org/rest-api/reference/posts/
 */
class Posts
{
    const CACHE_PREFIX = 'posts';

    protected string $url;
    protected bool $shouldCache;

    protected array $attributes = [
        'order' => 'desc',
        'orderby' => 'date',
        'page' => 1,
        'per_page' => 10,
    ];

    public function __construct(string $url, bool $shouldCache = true)
    {
        $this->url = $url . '/posts';
        $this->shouldCache = $shouldCache;
    }

    public function slug(string $slug) : self
    {
        return $this->setAttribute('slug', $slug);
    }

    public function take(int $number) : self
    {
        return $this->setAttribute('per_page', $number);
    }

    public function page(int $number) : self
    {
        return $this->setAttribute('page', $number);
    }

    public function next() : self
    {
        return $this->setAttribute('page', $this->attributes['page'] + 1);
    }

    protected function setAttribute(string $attribute, string $value) : self
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    public function get() : array
    {
        if ($this->shouldCache) {
            return Cache::tags([CacheHelper::PREFIX])
                ->remember(
                    CacheHelper::PREFIX . static::CACHE_PREFIX . $this->hash(),
                    CacheHelper::TTL,
                    function () {
                        return $this->getRaw();
                    }
                );
        }

        return $this->getRaw();
    }

    protected function getRaw() : array
    {
        $client = new Client();

        return json_decode($client->get($this->url, [
            'query' => $this->attributes,
        ])
            ->getBody()
            ->getContents());
    }

    /**
     * @return array|Post[]
     */
    public function getTransformed() : array
    {
        return array_map(function ($item) {
            return new Post($item);
        }, $this->get());
    }

    protected function hash() : string
    {
        return Hash::make(json_encode($this->attributes));
    }
}
