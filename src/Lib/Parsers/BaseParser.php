<?php
namespace App\Lib\Parsers;
use \Exception;
abstract class BaseParser {
    private $_url;
    private $_source;

    public function __construct($url,$source){
        $this->_url = $url;
        $this->_source = $source;
    }

    abstract function parse();

    public function getUrl() {
        return $this->_url;
    }

    public function getSource(){
        return $this->_source;
    }
}