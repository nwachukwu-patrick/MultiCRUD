<?php
namespace conf;
class config{
    private $db_host;
    private $db_password;
    private $db_user;
    private $app_name;
    private $app_header_color;
    private $app_footer_color;
    private $app_background_color;
    private $app_foreground_color;
    private $url;
    function __construct(){
        $file =__DIR__."/settings.json";
       $setting  = file_get_contents($file);
       $setting =json_decode($setting);
        $this->db_host = $setting->{'db_host'};
        $this->db_password = $setting->{'db_password'};
        $this->db_user = $setting->{'db_user'};
        $this->app_name =  $setting->{'app_name'};
        $this->app_header_color = $setting->{'app_header_color'};
        $this->app_footer_color = $setting->{'app_footer_color'};
        $this->app_background_color = $setting->{'app_background_color'};
        $this->app_foreground_color = $setting->{'app_foreground_color'};
        $this->url = $setting->{'url'};

    }
    function getAppName(){
        return $this->app_name;
    }
    function getHost(){
    return $this->db_host;
    }
    function getDbPassword(){
        return $this->db_password;
        }
    function getDbUser(){
    return $this->db_user;
    }
    function getHeaderColor(){
        return $this->app_header_color;
        }
    function getFooterColor(){
            return $this->app_footer_color;
            }
    function getBackgroundColor(){
                return $this->app_background_color;
                }
    function getForegroundColor(){
                    return $this->app_foreground_color;
                    }
   
    function turnError(){
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    }
}
