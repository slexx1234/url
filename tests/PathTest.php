<?php

use Slexx\Url\Path;
use PHPUnit\Framework\TestCase;

class PathTest extends TestCase
{
    public function testAll()
    {
        $this->assertEquals(['users', '5'], (new Path('users/5'))->all());
        $this->assertEquals(['users', '5'], (new Path('/users/5'))->all());
        $this->assertEquals(['users', '5'], (new Path('/users/5/'))->all());
    }

    public function testCount()
    {
        $this->assertEquals(2, count(new Path('users/5')));
    }

    public function testGet()
    {
        $path = new Path('users/5');
        $this->assertEquals('users', $path->get(0));
        $this->assertNull($path->get(2));
    }

    public function testHas()
    {
        $path = new Path('users/5');
        $this->assertTrue($path->has(0));
        $this->assertFalse($path->has(2));
    }

    public function testSet()
    {
        $path = new Path('users/5');
        $this->assertEquals(['users', '5'], $path->all());
        $path->set(2, 'edit');
        $this->assertEquals(['users', '5', 'edit'], $path->all());
    }

    public function testAdd()
    {
        $path = new Path('users/5');
        $this->assertEquals(['users', '5'], $path->all());
        $path->add('edit');
        $this->assertEquals(['users', '5', 'edit'], $path->all());
    }

    public function testRemove()
    {
        $path = new Path('users/5');
        $this->assertEquals(['users', '5'], $path->all());
        $path->remove(0);
        $this->assertEquals(['5'], $path->all());
    }

    public function testToString()
    {
        $this->assertEquals('/users/5', (string) new Path('users/5'));
    }

    public function testMath()
    {
        $this->assertEquals(['id' => '5'], (new Path('users/5'))->match('/users/[id]'));
        $this->assertEquals(['login' => 'lexa'], (new Path('users/lexa'))->match('users/[login:[a-z0-9\-_]+]'));
        $this->assertEquals(['login' => 'lexa'], (new Path('users/lexa'))->match('/users/[login]', ['login' => '[a-z0-9\-_]+']));
        $this->assertEquals(['post' => '5', 'comment' => '34', 'action' => 'edit'], (new Path('posts/5/comments/34/edit'))->match('/posts/[post:id]/comments/[comment:id]/[action:alpha]'));
    }
}

