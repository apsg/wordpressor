<?php
namespace Apsg\Wordpressor\Commands;

use Illuminate\Console\Command;

class RefreshCommand extends Command
{
    protected $name = 'wordpressor:refresh';
    protected $description = 'Refresh Wordpressor clear cache and precache.';

    public function handle()
    {
        $this->call('wordpressor:clear');
        $this->call('wordpressor:cache');
    }
}
