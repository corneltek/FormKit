<?php

class SeleniumTest extends PHPUnit_Extensions_SeleniumTestCase
{
    protected $captureScreenshotOnFailure = TRUE;

    protected $screenshotPath = __DIR__;

    protected $screenshotUrl = 'http://localhost/screenshots';

    public $url;

    protected function setUp()
    {
        $this->url = getenv('TESTING_URL');
        if( $this->url ) {
            $this->setBrowserUrl( $this->url );
        } else {
            $this->markTestSkipped('TESTING_URL is required.');
        }
        $this->setBrowser('*firefox');
		$this->setSleep(2500);

    }
 
    public function testTitle()
    {
        $this->open( $this->url );
        $this->assertTitle('Example WWW Page');
    }

    public function test()
    {
    
    }
}




