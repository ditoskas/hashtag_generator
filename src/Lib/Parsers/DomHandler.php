<?php
namespace App\Lib\Parsers;

use PHPHtmlParser\Dom;

/**
 * Interface to manipulate the page source code as xml
 * Class DomHandler
 * @package App\Lib\Parsers
 */
class DomHandler {
    private $_dom;
    private $_url;
    public function __construct($url){
        $this->_url = $url;
        $this->_dom = new Dom();
        $this->_dom->load($this->_url);
    }

    /**
     * Find the meta element with name keywords and extract the words
     * @return mixed
     */
    public function extractKeywords(){
        $strKeywords = $this->_dom->find('meta[name="keywords"]')->getAttribute('content');
        return explode(',',$strKeywords);
    }

    /**
     * Find the text on the page and separate the words
     * @return array
     */
    public function extractBody(){
        $strBody = $this->_dom->find('body')->text(true);
        $words = $this->_getWords($strBody);
        $result = [];
        if (!empty($words)){
            foreach ($words as $forHashtag => $numberOfFinds){
                if ($numberOfFinds < 5) {
                    break;
                }//if
                $result[] = $forHashtag;
            }//foreach
        }//if
        return $result;
    }

    /**
     * Get an array with the unique words and the number of times that every word exists
     * @param $txt
     * @return array - The words are the key and the number of times is the value
     * @see http://stackoverflow.com/questions/2984786/php-sort-and-count-instances-of-words-in-a-given-string?answertab=active#tab-top
     */
    private function _getWords($txt){
        $words = array_count_values(str_word_count($txt,1));
        arsort($words);
        return $words;
    }
}