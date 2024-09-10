<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;

class AddProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crwlr:addproject {projectname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a new project for crawling.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $projectname = $this->argument('projectname');
        echo "Creating a new project - ".$projectname."\n"; 
        $project = new Project;
        $project->name = $projectname;
        $project->save();
    }
}
