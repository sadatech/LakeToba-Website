<?php
use SearchAndGoElated\Modules\Header\Lib;

if(!function_exists('search_and_go_elated_set_header_object')) {
    function search_and_go_elated_set_header_object() {
        $header_type = 'header-standard';

        $object = Lib\HeaderFactory::getInstance()->build($header_type);

        if(Lib\HeaderFactory::getInstance()->validHeaderObject()) {
            $header_connector = new Lib\HeaderConnector($object);
            $header_connector->connect($object->getConnectConfig());
        }
    }

    add_action('wp', 'search_and_go_elated_set_header_object', 1);
}