<?php
namespace Apsg\Wordpressor;

class Wordpressor
{
    protected string $apiUrl;

    private bool $shouldCache;

    public function __construct()
    {
        $this->apiUrl = trim(config('wordpressor.url'), '/ ') . '/wp-json/wp/v2';
        $this->shouldCache = config('wordpressor.cache');
    }

    public function posts() : Posts
    {
        return new Posts($this->apiUrl, $this->shouldCache);
    }

    public function media() : Media
    {
        return new Media($this->apiUrl, $this->shouldCache);
    }
}
