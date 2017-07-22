<?php

use Slexx\Url\Query;
use PHPUnit\Framework\TestCase;

class QueryTest extends TestCase
{
    const ARRAY = [
        'foo' => 'bar',
        'bar' => 'baz'
    ];

    const STRING = 'foo=bar&bar=baz';

    public function testAll()
    {
        $this->assertEquals(self::ARRAY, (new Query(self::STRING))->all());
    }

    public function testCount()
    {
        $this->assertEquals(2, count(new Query(self::STRING)));
    }

    public function testHas()
    {
        $query = new Query(self::STRING);
        $this->assertTrue($query->has('foo'));
        $this->assertFalse($query->has('other'));
    }

    public function testGet()
    {
        $query = new Query(self::STRING);
        $this->assertEquals('bar', $query->get('foo'));
        $this->assertNull($query->get('other'));
    }

    public function testSet()
    {
        $query = new Query(self::STRING);
        $this->assertEquals('bar', $query->get('foo'));
        $query->set('foo', 'foo');
        $this->assertEquals('foo', $query->get('foo'));
    }

    public function testRemove()
    {
        $query = new Query(self::STRING);
        $this->assertEquals('bar', $query->get('foo'));
        $query->remove('foo');
        $this->assertNull($query->get('foo'));
    }

    public function testToString()
    {
        $this->assertEquals(self::STRING, (string) new Query(self::STRING));
    }
}

