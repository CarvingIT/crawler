<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use App\Models\Site;

class AddSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crwlr:add-site {project_id} {sub_domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add base url of a website to a project';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $project_id = $this->argument('project_id');
        $project = Project::find($project_id);
        if(!$project){
            die("There is no project corresponding to the ID you entered.\n");
        }
        $sub_domain = $this->argument('sub_domain');
        $site = new Site;
        $site->project_id = $project_id;
        $site->sub_domain = $sub_domain; 
        $site->save();
        echo 'Added a new site to project - '. $project->name."\n";
        
        $this->call('crwlr:list-projects');
    }
}
