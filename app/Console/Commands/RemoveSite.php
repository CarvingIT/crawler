<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Site;

class RemoveSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crwlr:remove-site {site_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes a site from a project.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $site_id = $this->argument('site_id');
        Site::find($site_id)->delete();
    }
}
