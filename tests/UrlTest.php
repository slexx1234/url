<?php

use Slexx\Url\Url;
use Slexx\Url\Host;
use Slexx\Url\Path;
use Slexx\Url\Query;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    public function testParse()
    {
        $this->assertEquals([
            'scheme' => 'http',
            'user' => 'username',
            'password' => 'password',
            'host' => 'hostname',
            'port' => 9090,
            'path' => '/path',
            'query' => 'arg=value',
            'flag' => 'anchor',
        ], Url::parse('http://username:password@hostname:9090/path?arg=value#anchor'));
        $this->assertEquals([
            'scheme' => null,
            'user' => null,
            'password' => null,
            'host' => 'hostname',
            'port' => null,
            'path' => null,
            'query' => null,
            'flag' => null,
        ], Url::parse('hostname'));
        $this->assertEquals([
            'scheme' => null,
            'user' => 'user',
            'password' => 'password',
            'host' => 'example.com',
            'port' => null,
            'path' => null,
            'query' => null,
            'flag' => null,
        ], Url::parse('user:password@example.com'));
        $this->assertEquals([
            'scheme' => null,
            'user' => null,
            'password' => null,
            'host' => null,
            'port' => null,
            'path' => '/path',
            'query' => null,
            'flag' => 'anchor',
        ], Url::parse('/path#anchor'));
    }

    public function testGetScheme()
    {
        $this->assertEquals('http', (new Url('http://example.com'))->getScheme());
        $this->assertEquals('https', (new Url('https://example.com'))->getScheme());
        $this->assertNull((new Url(''))->getScheme());
    }

    public function testSetScheme()
    {
        $url = new Url('http://example.com');
        $this->assertEquals('http', $url->getScheme());
        $url->setScheme('https');
        $this->assertEquals('https', $url->getScheme());
    }

    public function testGetHost()
    {
        $url = new Url('http://example.com');
        $this->assertEquals('example.com', (string) $url->getHost());
        $this->assertTrue($url->getHost() instanceof Host);
    }

    public function testSetHost()
    {
        $url = new Url('http://example.com');
        $this->assertEquals('example.com', (string) $url->getHost());
        $url->setHost('www.example.com');
        $this->assertEquals('www.example.com', (string) $url->getHost());
    }

    public function testGetPort()
    {
        $this->assertEquals(80, (new Url('example.com:80'))->getPort());
        $this->assertNull((new Url('example.com'))->getPort());
    }

    public function testSetPort()
    {
        $url = new Url('example.com');
        $this->assertNull($url->getPort());
        $url->setPort(80);
        $this->assertEquals(80, $url->getPort());
    }

    public function testGetUser()
    {
        $this->assertEquals('user', (new Url('user@example.com'))->getUser());
        $this->assertNull((new Url('example.com'))->getUser());
    }

    public function testSetUser()
    {
        $url = new Url('example.com');
        $this->assertNull($url->getUser());
        $url->setUser('user');
        $this->assertEquals('user', $url->getUser());
    }

    public function testGetPassword()
    {
        $this->assertEquals('password', (new Url('user:password@example.com'))->getPassword());
        $this->assertNull((new Url('example.com'))->getPassword());
    }

    public function testSetPassword()
    {
        $url = new Url('example.com');
        $this->assertNull($url->getPassword());
        $url->setUser('user');
        $url->setPassword('password');
        $this->assertEquals('password', $url->getPassword());
    }

    public function testGetPath()
    {
        $url = new Url('example.com/path');
        $this->assertEquals('/path', (string) $url->getPath());
        $this->assertTrue($url->getPath() instanceof Path);

        $this->assertEquals('/', (string) (new Url('example.com'))->getPath());
    }

    public function testSetPath()
    {
        $url = new Url('example.com');
        $this->assertEquals('/', (string) $url->getPath());
        $url->setPath('path');
        $this->assertEquals('/path', (string) $url->getPath());
    }

    public function testGetQuery()
    {
        $url = new Url('example.com?foo=bar');
        $this->assertEquals('foo=bar', (string) $url->getQuery());
        $this->assertTrue($url->getQuery() instanceof Query);

        $this->assertEquals('', (string) (new Url('example.com'))->getQuery());
    }

    public function testSetQuery()
    {
        $url = new Url('example.com');
        $this->assertEquals('', (string) $url->getQuery());
        $url->setQuery('foo=bar');
        $this->assertEquals('foo=bar', (string) $url->getQuery());
    }

    public function testGetFlag()
    {
        $this->assertEquals('flag', (new Url('example.com#flag'))->getFlag());
        $this->assertNull((new Url('example.com'))->getFlag());
    }

    public function testSetFlag()
    {
        $url = new Url('example.com');
        $this->assertNull($url->getFlag());
        $url->setFlag('flag');
        $this->assertEquals('flag', $url->getFlag());
    }

    public function testToArray()
    {

        $this->assertEquals([
            'scheme' => 'http',
            'user' => 'username',
            'password' => 'password',
            'host' => 'hostname',
            'port' => 9090,
            'path' => '/path',
            'query' => 'arg=value',
            'flag' => 'anchor',
        ], (new Url('http://username:password@hostname:9090/path?arg=value#anchor'))->toArray());
        $this->assertEquals([
            'scheme' => null,
            'user' => null,
            'password' => null,
            'host' => 'hostname',
            'port' => null,
            'path' => null,
            'query' => null,
            'flag' => null,
        ], (new Url('hostname'))->toArray());
        $this->assertEquals([
            'scheme' => null,
            'user' => 'user',
            'password' => 'password',
            'host' => 'example.com',
            'port' => null,
            'path' => null,
            'query' => null,
            'flag' => null,
        ], (new Url('user:password@example.com'))->toArray());
    }

    public function testIsAbsolute()
    {
        $this->assertFalse((new Url('hostname'))->isAbsolute());
        $this->assertTrue((new Url('https://hostname'))->isAbsolute());
    }

    public function testIsRelative()
    {
        $this->assertTrue((new Url('hostname'))->isRelative());
        $this->assertFalse((new Url('https://hostname'))->isRelative());
    }

    public function testToString()
    {
        $this->assertEquals('example.com/', (string) new Url('example.com'));
        $this->assertEquals('http://username:password@hostname:9090/path?arg=value#anchor', (string) new Url('http://username:password@hostname:9090/path?arg=value#anchor'));
        $this->assertEquals('example.com/path#anchor', (string) new Url('example.com/path#anchor'));
    }

    public function testMatch()
    {
        $this->assertEquals([], (new Url('http://example.com/path'))->match('example.com'));
        $this->assertEquals(null, (new Url('https://example.com/path'))->match('http://example.com'));
        $this->assertEquals([], (new Url('https://example.com/path'))->match('https://example.com'));
        $this->assertEquals(['controller' => 'path'], (new Url('https://example.com/path'))->match('https://example.com/[controller]'));
        $this->assertEquals(null, (new Url('https://example.com/path'))->match('https://example.com/[int]'));
    }

    public function testIs()
    {
        $this->assertTrue((new Url('http://example.com/path'))->is('example.com'));
        $this->assertFalse((new Url('https://example.com/path'))->is('http://example.com'));
        $this->assertTrue((new Url('https://example.com/path'))->is('https://example.com'));
        $this->assertTrue((new Url('https://example.com/path'))->is('https://example.com/[controller]'));
        $this->assertFalse((new Url('https://example.com/path'))->is('https://example.com/[int]'));
    }
}
