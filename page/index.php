<?php

class page_index extends Page{
    function init(){
        parent::init();

        $this->add('H1')->set('Welcome');

        $command = array(
	        "command" => "DomainsListActive"
        );

        $response = $this->api->versio->send($command);

        var_dump($response);

    }
}
