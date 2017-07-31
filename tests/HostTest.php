<?php

use Slexx\Url\Host;
use PHPUnit\Framework\TestCase;

class HostTest extends TestCase
{
    public function testIsIPv4()
    {
        $this->assertFalse((new Host('example.com'))->isIPv4());
        $this->assertTrue((new Host('0.0.0.0'))->isIPv4());
        $this->assertFalse((new Host('[2001:0db8:11a3:09d7:1f34:8a2e:07a0:765d]'))->isIPv4());
    }

    public function testIsIPv6()
    {
        $this->assertFalse((new Host('example.com'))->isIPv6());
        $this->assertFalse((new Host('0.0.0.0'))->isIPv6());
        $this->assertTrue((new Host('[2001:0db8:11a3:09d7:1f34:8a2e:07a0:765d]'))->isIPv6());
    }

    public function testIsIP()
    {
        $this->assertFalse((new Host('example.com'))->isIP());
        $this->assertTrue((new Host('0.0.0.0'))->isIP());
        $this->assertTrue((new Host('[2001:0db8:11a3:09d7:1f34:8a2e:07a0:765d]'))->isIP());
    }

    public function testIsDomain()
    {
        $this->assertTrue((new Host('example.com'))->isDomain());
        $this->assertFalse((new Host('0.0.0.0'))->isDomain());
        $this->assertFalse((new Host('[2001:0db8:11a3:09d7:1f34:8a2e:07a0:765d]'))->isDomain());
    }

    public function testIsSubdomain()
    {
        $this->assertTrue((new Host('www.example.com'))->isSubdomain());
        $this->assertFalse((new Host('example.com'))->isSubdomain());
        $this->assertFalse((new Host('0.0.0.0'))->isSubdomain());
        $this->assertFalse((new Host('[2001:0db8:11a3:09d7:1f34:8a2e:07a0:765d]'))->isSubdomain());
    }

    public function testIsAscii()
    {
        $this->assertTrue((new Host('xn--tst-qla.de'))->isAscii());
        $this->assertFalse((new Host('täst.de'))->isAscii());
    }

    public function testIsUnicode()
    {
        $this->assertFalse((new Host('xn--tst-qla.de'))->isUnicode());
        $this->assertTrue((new Host('täst.de'))->isUnicode());
    }

    public function testIsIdn()
    {
        $this->assertTrue((new Host('xn--tst-qla.de'))->isIdn());
        $this->assertTrue((new Host('täst.de'))->isIdn());
        $this->assertFalse((new Host('example.com'))->isIdn());
    }

    public function testToAscii()
    {
        $host = new Host('täst.de');
        $host->toAscii();
        $this->assertEquals('xn--tst-qla.de', (string) $host);
    }

    public function testToUnicode()
    {
        $host = new Host('xn--tst-qla.de');
        $host->toUnicode();
        $this->assertEquals('täst.de', (string) $host);
    }
}
