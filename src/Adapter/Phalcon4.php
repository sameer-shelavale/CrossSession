<?php
namespace CrossSession\Adapter;

use CrossSession\SessionInterface;
use Phalcon\Session\Bag as SessionBag;
use Phalcon\Session as Session;

class Phalcon4 implements SessionInterface{

    protected $bucket = null;
    protected $session = null;

    public function __construct( $bucket = null ){
        $this->bucket = $bucket;
        if( $this->bucket && is_string( $this->bucket ) ){
            $this->session = new SessionBag( $this->bucket );
        }else{
            $this->session = new Session();
        }
    }

    public function set( $key, $value ){
        $this->session->set( $key, $value );
    }

    public function get( $key ){
        return $this->session->get( $key );
    }

    public function has( $key ){
        return $this->session->has( $key );
    }

    public function remove( $key ){
        return $this->session->remove( $key );
    }

    public function destroy(){
        if( $this->bucket && is_string( $this->bucket ) ){
            //phalcon4 has clear() method for buckets instead of destroy like in phalcon3
            return $this->session->clear();
        }else{
            return $this->session->destroy();
        }
    }

}