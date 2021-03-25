<?php
namespace Apsg\Wordpressor;

class Wordpressor
{
    public function __construct()
    {
        $this->apiUrl = trim(config('wordpressor.url'), '/ ') . '/wp-json/wp/v2';
    }

    public function posts() : Posts
    {
        return new Posts($this->apiUrl);
    }

    public function media() : Media
    {
        return new Media($this->apiUrl);
    }
}
