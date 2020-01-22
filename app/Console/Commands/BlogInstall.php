<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BlogInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install basic data for the Blog Application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        File::deleteDirectory(public_path("img/articles"));
        File::deleteDirectory(public_path("img/avatars"));

        $copyStatus = File::copyDirectory(public_path("img/test"), public_path("img/"));

        if($copyStatus) {
            $this -> info("Images successfully copied");
        }

        try {
            $this -> call('migrate:fresh', [
                '--seed' => true,
                '--force' => true,
            ]);
        } catch (\Exception $e) {
            $this -> error('Error setting database data');
        }

        $this -> info("The blog has been installed correctly.");
    }
}
