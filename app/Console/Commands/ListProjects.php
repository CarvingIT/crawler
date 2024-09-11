<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;

class ListProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crwlr:list-projects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $projects = Project::all();
        foreach($projects as $p){
            echo $p->id.': '.$p->name."\n";
            foreach($p->sites as $s){
                echo "\t(".$s->id.') '. $s->sub_domain."\n";
            }
        }
    }
}
