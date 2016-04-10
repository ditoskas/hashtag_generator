<?php
namespace App\Test\TestCase\Lib\Parsers;

use App\Lib\Parsers\WebsiteParser;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\SourcesHelper Test Case
 */
class WebsiteParserTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Lib\Parsers\WebsiteParser
     */
    public $Parser;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Parser = new WebsiteParser('http://toskas.gr');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Parser);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->assertInstanceOf('App\Lib\Parsers\WebsiteParser',$this->Parser);
    }

    public function testGetUrl(){
        $url = $this->Parser->getUrl();
        $this->assertEquals('http://toskas.gr',$url);
    }
    public function testGetSource(){
        $url = $this->Parser->getSource();
        $this->assertEquals('Website',$url);
    }
    public function testParse(){
        $hashtags = $this->Parser->parse();
        $expected = [
            'projects',
            'software_engineer',
            'web_development',
            'resume',
            'cv',
            'php',
            'css',
            'jquery',
            'freelancer',
            'Techologies',
            'gr',
        ];
        $this->assertEquals($expected,$hashtags);
    }
}
