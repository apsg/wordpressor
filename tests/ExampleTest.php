<?php
namespace Apsg\Wordpressor\Tests;

use Apsg\Wordpressor\DTO\Post;
use Apsg\Wordpressor\Wordpressor;

class ExampleTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->app['config']->set('wordpressor.url', 'https://gackowski.edu.pl');
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function it_retrieves_posts()
    {
        // when
        $wp = new Wordpressor;
        $posts = $wp->posts()
            ->take(3)
            ->get();

        // then
        $this->assertIsArray($posts);
        $this->assertCount(3, $posts);
    }

    /** @test */
    public function it_transforms_data()
    {
        // given
        $posts = (new Wordpressor)->posts()
            ->take(3)
            ->getTransformed();

        // when
        $post = $posts[0];

        // then
        $this->assertTrue($post instanceof Post);

        dd($post->image());
    }
}
