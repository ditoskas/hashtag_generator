<?php
namespace App\Test\TestCase\Lib\Parsers;

use App\Lib\Parsers\Hashtag;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\SourcesHelper Test Case
 */
class HashtagTest extends TestCase
{
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    public function testGenarate(){
        $word = '   devel#oper  ';
        $result = Hashtag::generate($word);
        $this->assertEquals('developer',$result);
    }
    public function testHash(){
        $word = '   devel#oper  ';
        $result = Hashtag::hash($word,true);
        $this->assertEquals('#developer',$result);
    }
}
