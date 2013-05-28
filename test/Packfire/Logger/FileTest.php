<?php

namespace Packfire\Logger;

class FileTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {

    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    public function testConstructorDefaultParameters()
    {
        $logger = new File('testFile');

        $this->assertInstanceOf('Psr\\Log\\LoggerInterface', $logger);
        $this->assertEquals('testFile', $logger->file());
        $this->assertInstanceOf('Packfire\\Logger\\Format\\Standard', $logger->format());
        $this->assertEquals(File::SIZE_UNLIMITED, $logger->maxSize());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorInvalidFile()
    {
        $logger = new File('');
    }

    public function testLog()
    {
        $name = tempnam(sys_get_temp_dir(), 'logger');

        $logger = new File($name);
        $fh = fopen($name, 'r');
        $logger->log('test', 'cool');
        rewind($fh);
        $output = stream_get_contents($fh);
        fclose($fh);
        unlink($name);

        $this->assertRegExp('/^\d{2} \w{3} \d{4} \d{2}:\d{2}\.\d{2} \+\d{4} \[test\] cool\n$/', $output);
    }
}
