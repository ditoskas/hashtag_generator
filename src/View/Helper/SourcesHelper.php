<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Sources helper
 * @property \Cake\View\Helper\HtmlHelper $Html
 */
class SourcesHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public $helpers = ['Html'];
    /**
     * Javascript files per layout
     * @var array
     */
    protected $_js = [
        'default'      =>  [
            'jquery/jquery-2.2.3.min',
            'jquery/jquery-migrate-1.2.1.min',
            'bootstrap-3.3.6/bootstrap.min',
            'hashtag',
            'hash.handler'
        ]
    ];
    /**
     * CSS files per layout
     * @var array
     */
    protected $_css = [
        'default'      =>  [
            'bootstrap-3.3.6/css/bootstrap.min',
            'https://fonts.googleapis.com/css?family=Oswald',
            'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
            'bootstrap.overloads',
            'main'
        ]
    ];
    /**
     * Get the javascript files based on the layout
     * @param string $layout - Layout name
     * @return a list of script tags
     */
    public function getJs($layout = 'default'){
        $js = null;
        if (isset($this->_js[$layout])){
            $js = $this->Html->script($this->_js[$layout]);
        }
        return $js;
    }
    /**
     * Get the css files based on the layout
     * @param string $layout - Layout name
     * @return a list of style tags
     */
    public function getCss($layout = 'default'){
        $css = null;
        if (isset($this->_css[$layout])){
            $css = $this->Html->css($this->_css[$layout]);
        }
        return $css;
    }
}
