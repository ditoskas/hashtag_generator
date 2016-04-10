<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Exception\AuthSecurityException;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use PHPHtmlParser\Exceptions\EmptyCollectionException;
use PHPHtmlParser\Exceptions\CurlException;
use App\Lib\Parsers;
use App\Lib\Parsers\WebsiteParser;
use Cake\Validation\Validator;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function home(){
    }

    public function testCoverage(){}
    public function requestHashtags(){
        $this->viewBuilder()->layout('ajax');
        if ($this->request->is('ajax')) {
            $url = trim($this->request->data['search']);
            if (!preg_match("#https?://#i",$url) ) { //fill the http in case of missing
                $url = 'http://'.$url;
            }
            //validate url
            $validator = new Validator();
            $validator->notBlank('url','URL can not be empty')->add('url','valid',['rule' => 'url']);

            $isValidUrl = $validator->errors(['url' => $url]);
            $result = [];
            if (empty($isValidUrl)) {
                try {
                    $dom = new WebsiteParser($url);
                    $websiteResults = $dom->parse();
                    $result = [
                        'type'      =>  'success',
                        'hashtags'    =>  $websiteResults
                    ];
                }
                catch (\Exception $ex){
                    if ($ex instanceof EmptyCollectionException){
                        $result = [
                            'type'      =>  'success',
                            'hashtags'    =>  []
                        ];
                    }
                    else if ($ex instanceof CurlException) {
                        $result = [
                            'type'      =>  'fail',
                            'reason'    =>  'Website does not exist'
                        ];
                    }
                    else {
                        $result = [
                            'type'      =>  'fail',
                            'reason'    =>  $ex->getMessage()
                        ];
                    }
                }
            }
            else {
                $result = [
                    'type'      =>  'fail',
                    'reason'    =>  'Invalid URL'
                ];
            }

            $this->set(compact('result'));
            $this->set('_serialize', ['result']);
        }
        else {
            throw new AuthSecurityException("Permission denied");
        }

    }
}
