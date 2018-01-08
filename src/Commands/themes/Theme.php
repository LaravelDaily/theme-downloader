<?php

namespace laraveldaily\ThemeDownloader;

use GuzzleHttp\Client;

class Theme
{
    protected $theme_name;

    protected function createDirectory($directory){
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    protected function checkClient($url)
    {
        try {
            $this->client = new Client();
            $this->client->request('GET', $url);
        }
        catch (ClientException $e){
            return false;
        }
        catch (RequestException $e){
            return false;
        }
        catch(ConnectException $e){
            return false;
        }

        return true;
    }
}