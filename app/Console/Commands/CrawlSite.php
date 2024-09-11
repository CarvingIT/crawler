<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Crawler\Crawler;
use Spatie\Crawler\CrawlProfiles\CrawlSubdomains;
use App\Custom\CrawlHandler;

class CrawlSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crwlr:crawl-site {site_url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl a given website.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $site_url = $this->argument('site_url');

        Crawler::create()
        ->setUserAgent('Bigfoot')
        ->setCrawlObserver(new CrawlHandler)
        ->setCrawlProfile(new CrawlSubdomains($site_url))
        ->startCrawling($site_url); 
    }
}
