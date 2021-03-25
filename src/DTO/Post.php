<?php
namespace Apsg\Wordpressor\DTO;

use Apsg\Wordpressor\Wordpressor;
use Illuminate\Support\Arr;
use stdClass;

/**
 *
 */
class Post
{
    public stdClass $data;

    public function __construct(stdClass $data)
    {
        $this->data = $data;
    }

    public function id() : int
    {
        return object_get($this->data, 'id');
    }

    public function title() : string
    {
        return object_get($this->data, 'title.rendered');
    }

    public function excerpt() : string
    {
        return object_get($this->data, 'excerpt.rendered');
    }

    public function contect() : string
    {
        return object_get($this->data, 'content.rendered');
    }

    public function image() : Medium
    {
        return (new Wordpressor)->media()->getTransformed(object_get($this->data, 'featured_media'));
    }
}
