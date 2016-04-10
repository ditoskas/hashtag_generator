<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\SourcesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\SourcesHelper Test Case
 */
class SourcesHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\SourcesHelper
     */
    public $Sources;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Sources = new SourcesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sources);

        parent::tearDown();
    }

    public function testGetCss()
    {
        $css = $this->Sources->getCss();
        $this->assertContains('<link rel="stylesheet" href="/css/bootstrap.overloads.css"/>',$css);
    }
    public function testGetJs()
    {
        $js = $this->Sources->getJs();
        $this->assertContains('<script src="/js/bootstrap-3.3.6/bootstrap.min.js"></script>',$js);
    }
}
