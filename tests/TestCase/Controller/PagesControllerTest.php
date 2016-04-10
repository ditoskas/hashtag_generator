<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         1.2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Test\TestCase\Controller;

use App\Controller\PagesController;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\TestSuite\IntegrationTestCase;
use Cake\View\Exception\MissingTemplateException;

/**
 * PagesControllerTest class
 */
class PagesControllerTest extends IntegrationTestCase
{

    /**
     * testDisplay method
     *
     * @return void
     */
    public function testHome()
    {
        $this->get('/pages/home');
        $this->assertResponseOk();
        $this->assertResponseContains('Welcome to #tag Generator');
    }

    public function testRequestHashtagsNormalPost()
    {
        $data = [
            'search'    =>  'toskas.gr'
        ];
        $this->post('/pages/request_hashtags',$data);
        $this->assertResponseError();
        $this->assertResponseContains('Permission denied');
    }

    public function testRequestHashtagsNormalGet()
    {
        $data = [
            'search'    =>  'toskas.gr'
        ];
        $this->get('/pages/request_hashtags');
        $this->assertResponseError();
        $this->assertResponseContains('Permission denied');
        //simulate ajax request
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }
    public function testRequestHashtagsAjaxPost()
    {
        $data = [
            'search'    =>  'toskas.gr'
        ];
        //simulate ajax request
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        $this->post('/pages/request_hashtags',$data);
        $this->assertResponseOk();
        $this->assertResponseContains('software_engineer');
        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }

    public function testInvalidUrl()
    {
        $data = [
            'search'    =>  'toskas'
        ];
        //simulate ajax request
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        $this->post('/pages/request_hashtags',$data);
        $this->assertResponseOk();
        $this->assertResponseContains('Invalid URL');
        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }

    public function testEmptyCollection()
    {
        $data = [
            'search'    =>  'facebook.com'
        ];
        //simulate ajax request
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        $this->post('/pages/request_hashtags',$data);
        $this->assertResponseOk();
        $this->assertResponseContains('success');
        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }

    public function testUrlNotExists()
    {
        $data = [
            'search'    =>  'thisurldoesnotexist.com'
        ];
        //simulate ajax request
        $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        $this->post('/pages/request_hashtags',$data);
        $this->assertResponseOk();
        $this->assertResponseContains('Website does not exist');
        unset($_ENV['HTTP_X_REQUESTED_WITH']);
    }

}
