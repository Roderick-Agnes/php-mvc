<?php
class UrlHelper
{
    protected $base_url = "http://localhost/php-mvc/";

    public function __construct()
    {
        $this->base_url = $_SERVER['SERVER_NAME'];
    }
    public static function get_base_url()
    {
        return $GLOBALS['base_url'];
    }
    public static function get_css_url()
    {
        return "public/assets/css/";
    }
    public static function get_js_url()
    {
        return "public/assets/js/";
    }
}
