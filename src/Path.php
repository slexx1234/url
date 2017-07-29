<?php

namespace Slexx\Url;

use Slexx\Pattern\Pattern;

class Path implements \Countable, \IteratorAggregate
{
    /**
     * @var array
     */
    protected $segments = [];

    /**
     * Path constructor.
     * @param string [$path]
     */
    public function __construct($path = '/')
    {
        $path = trim($path, '/');
        if (!empty($path)) {
            $this->segments = explode('/', $path);
        }
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->segments;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->all());
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }

    /**
     * @param int $index
     * @return string|null
     */
    public function get($index)
    {
        return $this->has($index) ? $this->segments[$index] : null;
    }

    /**
     * @param int $index
     * @return bool
     */
    public function has($index)
    {
        return isset($this->segments[$index]);
    }

    /**
     * @param int $index
     * @param string $value
     * @return void
     */
    public function set($index, $value)
    {
        $this->segments[$index] = $value;
    }

    /**
     * @param string $value
     * @return void
     */
    public function add($value)
    {
        $this->segments[] = $value;
    }

    /**
     * @param int $index
     * @return void
     */
    public function remove($index)
    {
        array_splice($this->segments, $index, 1);
    }

    /**
     * @param string $pattern
     * @return array|null
     */
    public function match($pattern)
    {
        return (new Pattern('/' . trim($pattern, '/')))->match($this->__toString());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return '/' . implode('/', $this->all());
    }

    /**
     * @return Path
     */
    public function __clone()
    {
        return new self($this->__toString());
    }
}

