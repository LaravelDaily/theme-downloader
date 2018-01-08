<?php

namespace laraveldaily\ThemeDownloader;

use Illuminate\Support\ServiceProvider;

class ThemeDownloaderServiceProvider extends ServiceProvider {

    public function boot(){

    }

    public function register(){

        $this->commands([
            ThemeDownloader::class
        ]);

    }

}