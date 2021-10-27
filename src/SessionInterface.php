<?php
namespace CrossSession;

interface SessionInterface{

    public function set( $key, $value );

    public function get( $key );

    public function has( $key );

    public function remove( $key );

    public function destroy();

}
