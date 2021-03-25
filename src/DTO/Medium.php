<?php
namespace Apsg\Wordpressor\DTO;

use stdClass;

class Medium
{
    protected stdClass $data;

    public function __construct(stdClass $object)
    {
        $this->data = $object;
    }

    public function featured() : string
    {
        return object_get($this->data, 'media_details.sizes.featured.source_url');
    }

    public function full() : string
    {
        return object_get($this->data, 'media_details.sizes.full.source_url');
    }

    public function thumbnail() : string
    {
        return object_get($this->data, 'media_details.sizes.thumbnail.source_url');
    }

    public function medium() : string
    {
        return object_get($this->data, 'media_details.sizes.medium.source_url');
    }

    public function large() : string
    {
        return object_get($this->data, 'media_details.sizes.large.source_url');
    }

    public function getSize(string $size) : string
    {
        return object_get($this->data, "media_details.sizes.{$size}.source_url");
    }
}
