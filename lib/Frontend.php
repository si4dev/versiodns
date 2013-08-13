<?php

class Frontend extends ApiFrontend {
    function init(){
        parent::init();

        //load versio API
        $this->versio = $this->add('Controller_VersioApi');

        //atk4-addons
        $this->addLocation('atk4-addons',array(
                    'php'=>array(
                        'mvc',
                        'misc/lib',
                        ))

        )->setParent($this->pathfinder->base_location);

        //jui
        $this->add('jUI');

    }
}
