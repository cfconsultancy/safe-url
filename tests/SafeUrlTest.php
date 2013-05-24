<?php

require_once dirname(__FILE__) . '/../SafeUrl.class.php';

/**
 * Test class for SafeUrl.
 * Generated by PHPUnit on 2010-04-20 at 12:57:43.
 */
class SafeUrlTest extends PHPUnit_Framework_TestCase {

    /**
     * @var SafeUrl
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new SafeUrl;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    public function testMakeUrl() {
        
            $this->assertEquals( $this->object->makeUrl(
                'i\'m a test string!! do u like me. or not......., billy bob!!@#'),
                'im-a-test-string-do-u-like-me-or-not-billy-bob');

            $this->assertEquals( $this->object->makeUrl(
                '<b>some HTML</b> in <i>here</i>!!~'),
                'some-html-in-here');

            $this->assertEquals( $this->object->makeUrl(
                'i!@#*#@ l#*(*(#**$*o**(*^v^*(e d//////e\\\\\\\\v,,,,,,,,,,n%$#@!~e*(+=t'),
                'i-love-devnet');

            $this->assertEquals( $this->object->makeUrl(
                'A lOng String wiTh a buNchess of words thats! should be -chopped- at the last whole word'),
                'a-long-string-with-a-bunchess-of-words-thats');

            $this->object->lowercase = false;
            $this->assertEquals( $this->object->makeUrl(
                'Eyjafjallajökull Glacier'),
                'Eyjafjallajokull-Glacier');

            $this->object->maxlength = 100;
            $this->assertEquals( $this->object->makeUrl(
                'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ'),
                'AAAAAAACEEEEIIIIDjNOOOOOOUUUUYBSsaaaaaaaceeeeiiiionoooooouuuyybyRr');

            $this->object->maxlength = 20;
            $this->assertEquals( $this->object->makeUrl(
                    $this->big_mess),
                    'safeurl-new-safeurl');

            /**
             * Regresstion test:
             *
             * If max length was so small that we where left with only one
             * word, then whole_word would leave us with an empty string.
             */
            $this->object->maxlength = 5;
            $this->object->whole_word = true;
            $this->assertEquals( $this->object->makeUrl(
                'supercalafragalisticexpialadoshus'),
                'super');
            

            /**
             * Acceptable Bug:
             *
             * It would be nice if we put a space between block level elements,
             * but it is kind of too much to ask for.
             */
            $this->object->maxlength = 200;
            $html = <<<HTML
                <div>
                    <h1>Title</h1>
                    <h2>Subtitle!</h2>Read the <a href="ReleaseNotes.html">Release Notes</a> for this Revision.<br/>
                </div>
HTML;
            $this->assertEquals( $this->object->makeUrl(
                    $html),
                    'Title-SubtitleRead-the-Release-Notes-for-this-Revision');
            /**                    ^
             * Look: --------------|
             *
             * Should be:
             *     'Title-Subtitle-Read-the-Release-Notes-for-this-Revision'
             */
    }
    
    var $big_mess = '
            </span></li><li style=\"\" class=\"li2\"><span style=\"color:
            #ff0000;\">\$safeurl = new safeurl(); </span></li><li style=\"\"
            class=\"li1\"><span style=\"color: #ff0000;\">\$safeurl->lowercase
            = false;</span></li><li style=\"\" class=\"li2\"><span
            style=\"color: #ff0000;\">\$safeurl->whole_word = false;</span></li>
            <li style=\"\" class=\"li1\">&nbsp;</li><li style=\"\"
            class=\"li2\"><span style=\"color: #ff0000;\">\$tests = array(
            </span></li><li style=\"\" class=\"li1\"><span style=\"color:
            #ff0000;\"> &nbsp; &nbsp; &nbsp; &nbsp;\'</span>i\span
            style=\"color: #ff0000;\">\'m a test string!! do u like me. or
            not......., billy bob!!@#\'</span>, </li><li style=\"\"
            class=\"li2\">&nbsp; &nbsp; &nbsp; &nbsp; <span
            style=\"color: #ff0000;\">\'<b>some HTML</b> in <i>here</i>!!~\'
            </span>, </li><li style=\"\" class=\"li1\">&nbsp; &nbsp; &nbsp;
            &nbsp; <span style=\"color: #ff0000;\">\'i!@#*#@ l#*(*(#**$*o**(*^v
            ^*(e d//////e<span style=\"color: #000099; font-weight: bold;\">\\
            </span><span style=\"color: #000099; font-weight: bold;\">\\</span>
            <span style=\"color: #000099; font-weight: bold;\">\\</span><span
            style=\"color: #000099; font-weight: bold;\">\\</span>v,,,,,,,,,,n%
            $#@!~e*(+=t\'</span>,</li>';

}

