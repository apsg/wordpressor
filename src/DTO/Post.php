<?php
namespace Apsg\Wordpressor\DTO;

use Apsg\Wordpressor\Wordpressor;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
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

    public function slug() : string
    {
        return object_get($this->data, 'slug');
    }

    public function date() : Carbon
    {
        return Carbon::parse(object_get($this->data, 'date'));
    }

    public function title() : string
    {
        return object_get($this->data, 'title.rendered');
    }

    public function excerpt() : string
    {
        return object_get($this->data, 'excerpt.rendered');
    }

    public function content() : string
    {
        return object_get($this->data, 'content.rendered');
    }

    /**
     * @return Medium|null
     */
    public function image()
    {
        $id = object_get($this->data, 'featured_media');

        if (empty($id)) {
            return null;
        }

        try {
            return (new Wordpressor)->media()->getTransformed($id);
        } catch (ClientException $exception) {
            return null;
        }
    }
}
