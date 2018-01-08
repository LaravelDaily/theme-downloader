<?php

namespace laraveldaily\ThemeDownloader;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class ClassimaxTheme extends Theme
{

    protected $theme_name;

    protected $client;

    function __construct()
    {
        $this->theme_name = 'classimax';
        $this->client = new Client();
    }

    function download()
    {
        $this->createDirectories();
        $this->getThemeFiles();
    }

    protected function getThemeFiles(){

        //vendor
        $this->getScripts();
        $this->getImages();
        $this->getStyles();
        $this->getPlugins();

        //views
        $this->getLayout();
        $this->getPartials();
        $this->getViews();

        //routes
        $this->getRouteFile();

        //controllers
        $this->getControllerFile();
    }

    protected function getControllerFile()
    {
        $res = $this->client->request("GET", 'https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/classimax/ClassimaxController.php');
        file_put_contents(base_path('app/Http/Controllers/ClassimaxController.php'), $res->getBody());
    }

    protected function getRouteFile()
    {
        $res = $this->client->request("GET", 'https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/classimax/classimax.php');
        file_put_contents(base_path('routes/classimax.php'), $res->getBody());

        if(file_exists( $web_route = base_path('routes/web.php'))){
            file_put_contents($web_route, "include 'classimax.php';", FILE_APPEND);
        }
    }

    protected function createDirectories()
    {
        //views
        $this->createDirectory(resource_path('views/' . $this->theme_name));
        $this->createDirectory(resource_path('views/' . $this->theme_name . '/partials'));
        $this->createDirectory(resource_path('views/' . $this->theme_name . '/layouts'));
        $this->createDirectory(resource_path('views/' . $this->theme_name . '/partials/blog'));
        $this->createDirectory(resource_path('views/' . $this->theme_name . '/partials/category'));
        $this->createDirectory(resource_path('views/' . $this->theme_name . '/partials/single-item'));
        $this->createDirectory(resource_path('views/' . $this->theme_name . '/partials/welcome'));

        //vendor
        $this->createDirectory(public_path('vendor'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/css'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/images'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/images/blog'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/images/call-to-action'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/images/footer'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/images/home'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/images/products'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/images/user'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/js'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/bootstrap'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/fancybox'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/fancybox/images'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/font-awesome'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/font-awesome/css'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/font-awesome/fonts'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/jquery'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/raty'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/seiyria-bootstrap-slider'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/slick-carousel'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/slick-carousel/slick'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/slick-carousel/slick/fonts'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/smoothscroll'));
        $this->createDirectory(public_path('vendor/' . $this->theme_name . '/plugins/tether'));
    }

    protected function getScripts()
    {
        $res = $this->client->request("GET", 'https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/classimax/vendor/js/scripts.js');
        file_put_contents(public_path('vendor/classimax/js/scripts.js'), $res->getBody());
    }

    protected function getPlugins()
    {
        //bootstrap/*
        $this->createPluginFile('bootstrap/bootstrap-grid.min.css');
        $this->createPluginFile('bootstrap/bootstrap-reboot.min.css');
        $this->createPluginFile('bootstrap/bootstrap.bundle.min.js');
        $this->createPluginFile('bootstrap/bootstrap.min.css');
        $this->createPluginFile('bootstrap/bootstrap.min.js');
        $this->createPluginFile('bootstrap/popper.min.js');

        //fancybox/*
        $this->createPluginFile('fancybox/jquery.fancybox.pack.css');
        $this->createPluginFile('fancybox/jquery.fancybox.pack.js');

        //fancybox/images/*
        $this->createPluginFile('fancybox/images/fancybox_loading.gif');
        $this->createPluginFile('fancybox/images/fancybox_loading@2x.gif');
        $this->createPluginFile('fancybox/images/fancybox_overlay.png');
        $this->createPluginFile('fancybox/images/fancybox_sprite.png');
        $this->createPluginFile('fancybox/images/fancybox_sprite@2x.png');

        //font-awesome/css/*
        $this->createPluginFile('font-awesome/css/font-awesome.min.css');

        //font-awesome/fonts/*
        $this->createPluginSpecificFile('font-awesome/fonts/FontAwesome.otf');
        $this->createPluginSpecificFile('font-awesome/fonts/fontawesome-webfont.eot');
        $this->createPluginSpecificFile('font-awesome/fonts/fontawesome-webfont.svg');
        $this->createPluginSpecificFile('font-awesome/fonts/fontawesome-webfont.ttf');
        $this->createPluginSpecificFile('font-awesome/fonts/fontawesome-webfont.woff');
        $this->createPluginSpecificFile('font-awesome/fonts/fontawesome-webfont.woff2');

        //jquery/*
        $this->createPluginFile('jquery/core.js');
        $this->createPluginFile('jquery/jquery.min.js');
        $this->createPluginFile('jquery/jquery.slim.min.js');

        //raty/*
        $this->createPluginFile('raty/jquery.raty-fa.js');

        //seiyria-bootstrap-slider/*
        $this->createPluginFile('seiyria-bootstrap-slider/bootstrap-slider.min.css');
        $this->createPluginFile('seiyria-bootstrap-slider/bootstrap-slider.min.js');

        //slick-carousel/slick/*
        $this->createPluginFile('slick-carousel/slick/ajax-loader.gif');
        $this->createPluginFile('slick-carousel/slick/slick-theme.css');
        $this->createPluginFile('slick-carousel/slick/slick.css');
        $this->createPluginFile('slick-carousel/slick/slick.min.js');

        //slick-carousel/slick/fonts/*
        $this->createPluginSpecificFile('slick-carousel/slick/fonts/slick.eot');
        $this->createPluginSpecificFile('slick-carousel/slick/fonts/slick.svg');
        $this->createPluginSpecificFile('slick-carousel/slick/fonts/slick.ttf');
        $this->createPluginSpecificFile('slick-carousel/slick/fonts/slick.woff');

        //smoothscroll/*
        $this->createPluginFile('smoothscroll/SmoothScroll.min.js');

        //tether/*
        $this->createPluginFile('tether/tether-theme-arrows-dark.min.css');
        $this->createPluginFile('tether/tether-theme-arrows.min.css');
        $this->createPluginFile('tether/tether-theme-basic.min.css');
        $this->createPluginFile('tether/tether.min.css');
        $this->createPluginFile('tether/tether.min.js');
    }

    protected function createPluginFile($file_path)
    {
        $res = $this->client->request('GET', "https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/classimax/vendor/plugins/{$file_path}");
        file_put_contents(public_path("vendor/classimax/plugins/{$file_path}"), $res->getBody());
    }

    protected function createPluginSpecificFile($file_path)
    {
        $resource = fopen(public_path("vendor/classimax/plugins/{$file_path}"), 'w');
        $this->client->request("GET", "https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/classimax/vendor/plugins/{$file_path}",
            ['sink' => $resource]);
    }

    protected function getImages()
    {
        //images/*
        $this->createImage('logo-footer.png');
        $this->createImage('logo.png');
        $this->createImage('nav-toogle-icon.png');


        //images/blog/*
        $this->createImage('blog/post-1.jpg');
        $this->createImage('blog/post-2.jpg');
        $this->createImage('blog/post-3.jpg');
        $this->createImage('blog/post-4.jpg');
        $this->createImage('blog/post-5.jpg');
        $this->createImage('blog/video-icon.png');

        //images/call-to-action/*
        $this->createImage('call-to-action/cta-background.jpg');

        //images/footer/*
        $this->createImage('footer/phone-icon.png');

        //images/home/*
        $this->createImage('home/hero.jpg');

        //images/products/*
        $this->createImage('products/products-1.jpg');
        $this->createImage('products/products-2.jpg');
        $this->createImage('products/products-3.jpg');
        $this->createImage('products/products-4.jpg');

        //images/user/*
        $this->createImage('user/user-thumb.jpg');
    }

    protected function createImage($file_path)
    {
        $res = $this->client->request('GET', "https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/classimax/vendor/images/{$file_path}");
        file_put_contents(public_path("vendor/classimax/images/{$file_path}"), $res->getBody());
    }

    protected function getStyles()
    {
        $res = $this->client->request("GET", 'https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/classimax/vendor/css/style.css');
        file_put_contents(public_path('vendor/classimax/css/style.css'), $res->getBody());
    }

    protected function getLayout()
    {
        $res = $this->client->request("GET", 'https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/classimax/views/layouts/app.blade.php');
        file_put_contents(resource_path('views/classimax/layouts/app.blade.php'), $res->getBody());
    }

    protected function getPartials()
    {
        //partials/*
        $this->createPartial('footers.blade.php');
        $this->createPartial('ie-scripts.blade.php');
        $this->createPartial('links.blade.php');
        $this->createPartial('navbar.blade.php');
        $this->createPartial('scripts.blade.php');
        $this->createPartial('search.blade.php');

        //partials/blog/*
        $this->createPartial('blog/content.blade.php');
        $this->createPartial('blog/title.blade.php');

        //partials/category/*
        $this->createPartial('category/products.blade.php');
        $this->createPartial('category/sidebar.blade.php');

        //partials/single-item/*
        $this->createPartial('single-item/product-info.blade.php');

        //partials/welcome/*
        $this->createPartial('welcome/all-category.blade.php');
        $this->createPartial('welcome/hero-area.blade.php');
        $this->createPartial('welcome/popular-deals.blade.php');
    }

    protected function createPartial($file_path)
    {
        $res = $this->client->request('GET', "https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/classimax/views/partials/{$file_path}");
        file_put_contents(resource_path("views/classimax/partials/$file_path"), $res->getBody());
    }

    protected function getViews()
    {
        //views/*
        $this->createView('blog.blade.php');
        $this->createView('category.blade.php');
        $this->createView('dashboard.blade.php');
        $this->createView('single-blog.blade.php');
        $this->createView('single-item.blade.php');
        $this->createView('user-profile.blade.php');
        $this->createView('welcome.blade.php');
    }

    protected function createView($file_path)
    {
        $res = $this->client->request('GET', "https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/classimax/views/{$file_path}");
        file_put_contents(resource_path("views/classimax/$file_path"), $res->getBody());
    }

    function checkClientsAvailability()
    {
        return $this->checkClient('https://raw.githubusercontent.com/LaravelDaily/theme-downloader-themes/master/classimax/classimax.php');
    }

}