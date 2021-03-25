<?php
namespace Apsg\Wordpressor;

use Apsg\Wordpressor\DTO\Medium;
use GuzzleHttp\Client;
use stdClass;

class Media
{
    protected string $url;

    public function __construct(string $url)
    {
        $this->url = $url . '/media/';
    }

    public function get(int $id) : stdClass
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
