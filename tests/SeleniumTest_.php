<?php

class SeleniumTest_ extends PHPUnit_Extensions_SeleniumTestCase
{
    protected $captureScreenshotOnFailure = TRUE;

    protected $screenshotPath = __DIR__;

    protected $screenshotUrl = 'http://localhost/screenshots';

    public $url;

    function setUp()
    {
        $this->url = getenv('TESTING_URL');
        if( $this->url ) {
            $this->setBrowserUrl( $this->url );
        } else {
            $this->markTestSkipped('TESTING_URL is required.');
            return;
        }
        $this->setBrowser('*firefox');
		$this->setSleep(2500);

    }
 
    function testTitle()
    {
        $this->open( $this->url );
        $this->assertTitle('Example WWW Page');
    }

    function test()
    {
    
    }
}




