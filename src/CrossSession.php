<?php
namespace CrossSession;


class CrossSession
{
    private $framework = null;
    public $manager = null;

    public function __construct( $bucket = null, $framework = 'php' ){
        $this->framework = $framework;
        if( $framework == 'PHALCON3' ){
            $this->manager = new \CrossSession\Adapter\Phalcon3($bucket);
        }elseif( $framework == 'PHALCON4' ){
            $this->manager = new \CrossSession\Adapter\Phalcon4($bucket);
        }elseif( $framework = 'php' ){
            $this->manager = new \CrossSession\Adapter\Php($bucket);
        }
    }

    public function set( $key, $value ){
        $this->manager->set($key, $value);
    }

    public function get( $key ){
        return $this->manager->get( $key );
    }

    public function has( $key ){
        return $this->manager->has( $key );
    }

    public function remove( $key ){
        return $this->manager->remove( $key );
    }

    public function destroy(){
        return $this->manager->destroy();
    }

}