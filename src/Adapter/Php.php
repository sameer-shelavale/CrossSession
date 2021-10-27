<?php
namespace CrossSession\Adapter;

use CrossSession\SessionInterface;

class Php implements SessionInterface{

    protected $bucket = null;
    protected $session = null;

    public function __construct( $bucket = null ){
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        $this->bucket = $bucket;
        if($this->bucket && is_string($this->bucket)){
            //create empty bucket if not exist
            if(!isset($_SESSION[ $this->bucket ])){
                $_SESSION[ $this->bucket ] = [];
            }
        }
    }

    public function set( $key, $value ){
        if($this->bucket && is_string($this->bucket)){
            $_SESSION[$this->bucket][$key] = $value;
        }else{
            $_SESSION[$key] = $value;
        }
    }

    public function get( $key ){
        if($this->bucket && is_string($this->bucket)){
            if(isset($_SESSION[$this->bucket][$key])) {
                return $_SESSION[$this->bucket][$key];
            }
        }else{
            if(isset($_SESSION[$key])) {
                return $_SESSION[$key];
            }
        }
        return null;
    }

    public function has( $key ){
        if($this->bucket && is_string($this->bucket)){
            if(isset($_SESSION[$this->bucket][$key])) {
                return true;
            }
        }else{
            if(isset($_SESSION[$key])) {
                return true;
            }
        }
        return false;
    }

    public function remove( $key ){
        $this->session->remove( $key );
    }

    public function destroy(){
        return $this->session->destroy();
    }

}