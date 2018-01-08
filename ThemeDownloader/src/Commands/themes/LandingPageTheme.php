<?php

namespace laraveldaily\ThemeDownloader;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class LandingPageTheme extends Theme {

    protected $theme_name;

    protected $client;

    function __construct()
    {
        $this->theme_name = "landing-page";

        $this->client = new Client();
    }

    function download(){
        $this->createDirectories();
        $this->getThemeFiles();
    }

    protected function createDirectories()
    {
        //views
        $this->createDirectory(resource_path('views/' . $this->theme_name));
        $this->createDirectory(resource_path('views/' . $this->theme_name . '/partials'));

        //vendor
        $this->createDirectory(public_path('vendor'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/fonts'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/css'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/js'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/img'));
    }

    protected function getThemeFiles()
    {
        //fonts/*
        $this->createFontFile('Simple-Line-Icons.woff2');
        $this->createFontFile("fontawesome-webfont.woff2");

        //images/*
        $this->createImage("bg-masthead.jpg");
        $this->createImage("bg-showcase-1.jpg");
        $this->createImage("bg-showcase-2.jpg");
        $this->createImage("bg-showcase-3.jpg");
        $this->createImage("testimonials-1.jpg");
        $this->createImage("testimonials-2.jpg");
        $this->createImage("testimonials-3.jpg");

        //styles/*
        $this->createStyle('bootstrap.min.css');
        $this->createStyle('font-awesome.min.css');
        $this->createStyle('landing-page.min.css');
        $this->createStyle('simple-line-icons.css');

        //scripts/*
        $this->createScript('bootstrap.bundle.min.js');
        $this->createScript('jquery.min.js');

        //views/*
        $this->createView('welcome.blade.php');

        //views/partials/*
        $this->createPartial('call-to-action.blade.php');
        $this->createPartial('footer.blade.php');
        $this->createPartial( 'icons-grid.blade.php');
        $this->createPartial('image-showcases.blade.php');
        $this->createPartial('masthead.blade.php');
        $this->createPartial('navigation.blade.php');
        $this->createPartial('scripts.blade.php');
        $this->createPartial( 'testimonials.blade.php');
    }

    protected function createFontFile($file_name)
    {
        $resource = fopen(public_path("vendor/landing-page/fonts/{$file_name}"), 'w');
        $this->client->request("GET", "https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/landing-page/vendor/fonts/{$file_name}",
            ['sink' => $resource]);
    }

    protected function createImage($file_name)
    {
        $res = $this->client->request('GET', "https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/landing-page/vendor/img/$file_name");
        file_put_contents(public_path("vendor/landing-page/img/$file_name"), $res->getBody());
    }

    protected function createStyle($file_name)
    {
        $res = $this->client->request('GET', "https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/landing-page/vendor/css/$file_name");
        file_put_contents(public_path("vendor/landing-page/css/$file_name"), $res->getBody());
    }

    protected function createScript($file_name)
    {
        $res = $this->client->request('GET', "https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/landing-page/vendor/js/$file_name");
        file_put_contents(public_path("vendor/landing-page/js/$file_name"), $res->getBody());
    }

    protected function createView($file_name)
    {
        $res = $this->client->request('GET', "https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/landing-page/$file_name");
        file_put_contents(resource_path("views/landing-page/$file_name"), $res->getBody());
    }

    protected function createPartial($file_name)
    {
        $res = $this->client->request('GET', "https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/landing-page/partials/$file_name");
        file_put_contents(resource_path("views/landing-page/partials/$file_name"), $res->getBody());
    }

    function checkClientsAvailability()
    {
        return $this->checkClient('https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/landing-page/welcome.blade.php');
    }

}