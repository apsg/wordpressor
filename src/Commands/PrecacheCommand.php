<?php
namespace Apsg\Wordpressor\Commands;

use Apsg\Wordpressor\Wordpressor;
use Illuminate\Console\Command;

class PrecacheCommand extends Command
{
    protected $name = 'wordpressor:cache';
    protected $description = 'Precache Wordpressor for faster access of Wordpress resources';

    public function handle()
    {
        $wp = (new Wordpressor());

        for ($i = 0; $i < 3; $i++) {
            $wp->posts()->page(1)->get();
        }

        $this->info('Wordpressor precached!');
    }
}
