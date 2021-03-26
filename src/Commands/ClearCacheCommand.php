<?php
namespace Apsg\Wordpressor\Commands;

use Apsg\Wordpressor\CacheHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearCacheCommand extends Command
{
    protected $signature = 'wordpressor:clear';
    protected $description = 'Clear Wordpressor\'s cache, i.e. after new post was added';

    public function handle()
    {
        Cache::tags([CacheHelper::PREFIX])->clear();

        $this->info('Cleared');
    }
}
