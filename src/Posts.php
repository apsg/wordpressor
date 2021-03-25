<?php
namespace Apsg\Wordpressor;

use Apsg\Wordpressor\DTO\Post;
use GuzzleHttp\Client;

/**
 * @see https://developer.wordpress.org/rest-api/reference/posts/
 */
class Posts
{
    protected string $url;

    protected array $attributes = [
        'order' => 'desc',
        'orderby' => 'date',
        'page' => 1,
        'per_page' => 10,
    ];

    public function __construct(string $url)
    {
        $this->url = $url . '/posts';
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
        $this->setAttribute('page', $number);
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
}
