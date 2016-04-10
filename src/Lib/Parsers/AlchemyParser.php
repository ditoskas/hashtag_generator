<?php
namespace App\Lib\Parsers;


use App\Lib\Parsers\AlchemyAPI;
use App\Lib\Parsers\Hashtag;

/**
 * Parser for AlchemyAPI
 * Class AlchemyParser
 * @package App\Lib\Parsers
 */
class AlchemyParser extends BaseParser{
    private $_dom;
    public function __construct($url){
        $source = 'AlchemyAPI';
        $this->_dom = new AlchemyAPI();
        parent::__construct($url, $source);
    }

    public function parse(){
        return array_merge(
            Hashtag::generate($this->_extractEntities()),
            Hashtag::generate($this->_extractKeywords()),
            Hashtag::generate($this->_extractConcepts())
        );
    }

    protected function _extractConcepts(){
        $response = $this->_dom->concepts('url',$this->getUrl(),null);
        $result = [];
        if ($response['status'] == 'OK'){
            for ($i = 0; $i < count($response['concepts']); $i++){
                $current = $response['concepts'][$i];
                $result[] = $current['text'];
            }
        }
        return $result;
    }

    protected function _extractKeywords(){
        $response = $this->_dom->keywords('url',$this->getUrl(),['sentiment' => 1]);
        $result = [];
        if ($response['status'] == 'OK'){
            for ($i = 0; $i < count($response['keywords']); $i++){
                $current = $response['keywords'][$i];
                if ($current['relevance'] > 0.5 && $current['sentiment']['type'] == 'positive'){
                    $result[] = $current['text'];
                }
            }
        }
        return $result;
    }

    protected function _extractEntities(){
        $response = $this->_dom->entities('url',$this->getUrl(),['sentiment' => 1]);
        $result = [];
        $typesToParse = [
            'Company',
            'FieldTerminology',
            'JobTitle',
            'Organization',
        ];
        if ($response['status'] == 'OK'){
            for ($i = 0; $i < count($response['entities']); $i++){
                $current = $response['entities'][$i];
                if (array_search($current['type'],$typesToParse) && $current['sentiment']['type'] == 'positive'){
                    $result[] = $current['text'];
                }
            }
        }
        return $result;
    }
}