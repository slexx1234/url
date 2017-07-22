<?php

namespace Slexx\Url;

class Query implements \Countable, \IteratorAggregate
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * Query constructor.
     * @param string [$query]
     */
    public function __construct($query = '')
    {
        parse_str($query, $result);
        $this->data = $result;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->all());
    }

    /**
     * @param string|int $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * @param string|int$key
     * @return mixed
     */
    public function get($key)
    {
        return $this->has($key) ? $this->data[$key] : null;
    }

    /**
     * @param string|int $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @param string|int $key
     * @return void
     */
    public function remove($key)
    {
        unset($this->data[$key]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return http_build_query($this->data);
    }

    /**
     * @return Query
     */
    public function __clone()
    {
        return new self($this->__toString());
    }
}
