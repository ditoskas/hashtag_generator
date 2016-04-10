<?php
namespace App\Lib\Parsers;


use App\Lib\Parsers\DomHandler;
use App\Lib\Parsers\Hashtag;

/**
 * Main parser for the website as source
 * Class WebsiteParser
 * @package App\Lib\Parsers
 */
class WebsiteParser extends BaseParser{
    private $_dom;
    public function __construct($url){
        $source = 'Website';
        $this->_dom = new DomHandler($url);
        parent::__construct($url, $source);
    }

    public function parse(){
        return array_merge(
            Hashtag::generate($this->_dom->extractKeywords()),
            Hashtag::generate($this->_dom->extractBody())
        );
    }
}