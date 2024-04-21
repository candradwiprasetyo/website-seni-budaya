<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Check_device
{
    public function __construct()
    {
        // require_once("Mobile_Detect.php");

        // $detect = new Mobile_Detect();
        // $url = uri_string();
        // // Any mobile device (phones or tablets)
        // if ($detect->isTablet()){
        // } else if ($detect->isMobile()){
        //     $this->CI =& get_instance();
        //     header('Location: '. base_url().'mobile/'.$url);
        //     exit;
        // }
        // return $detect;
    }

    function get_layout() {
        require_once("Mobile_Detect.php");

        $detect = new Mobile_Detect();
        if ($detect->isTablet()) {
            $layout = 'layouts/';
        } else if ($detect->isMobile()) {
            $layout = 'layouts_mobile/';
        } else {
            $layout = 'layouts/';
        }
        return $layout;
    }

}
