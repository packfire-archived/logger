<?php

namespace Packfire\Logger\Format;

class StandardTest extends \PHPUnit_Framework_TestCase
{
    public function testFormat()
    {
        $format = new Standard();
        $result = $format->format('info', 'test message', array('test' => 1));
        $this->assertRegExp('/^\d{2} \w{3} \d{4} \d{2}:\d{2}\.\d{2} \+\d{4} \[info\] "test message" array \(  \'test\' => 1,\)$/', $result);
    }
}
