<?php
namespace Apsg\Wordpressor\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearCacheCommand extends Command
{
    protected $signature = 'wordpressor:clear';
    protected $description = 'Clear cache, i.e. after new post was added';

    public function handle()
    {
        Cache::flush();

        $this->info('Cleared');
    }
}
