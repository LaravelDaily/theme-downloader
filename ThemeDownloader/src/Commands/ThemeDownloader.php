<?php

namespace laraveldaily\ThemeDownloader;

use Illuminate\Console\Command;

class ThemeDownloader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:download {theme_name?}{--theme={theme_name} : Enter the name of the theme from https://startbootstrap.com/template-categories}';

    /**
     * Available themes at the moment
     *
     * @var array
     */
    protected $available_themes = [
        'landing-page'
    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Downloads BootStrap theme from startbootstrap.com/';

    /**
     * The name of the theme
     *
     * @var string
     */
    protected $theme_name;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->nameRefactoring();

        switch ($this->theme_name){

            case "landing-page":
                $this->landingPage();
                break;
            case "classimax":
                $this->classimax();
                break;

            default:
                $this->error("Theme doesn't exist or is unavailable for this package.");
        }
    }

    protected function landingPage(){
        $theme = new LandingPageTheme();
        if(!$theme->checkClientsAvailability()){
           $this->error("Server error. Check your internet connection or retry later.");
           return;
        }

        $this->info("Downloading theme...");

        $theme->download();

        $this->info("Your main view file is in resources/views/landing-page/welcome.blade.php");
    }

    protected function classimax(){
        $theme = new ClassimaxTheme();

        if(!$theme->checkClientsAvailability()){
            $this->error("Server error. Check your internet connection or retry later.");
            return;
        }

        $this->info("Downloading theme...");

        $theme->download();

        $this->info("Theme files downloaded successfully!");
    }

    protected function nameRefactoring()
    {
        $this->theme_name = $this->option('theme');

        $this->theme_name = strtolower($this->theme_name);

        $this->theme_name = str_replace(" ", "-", $this->theme_name);
    }
}
