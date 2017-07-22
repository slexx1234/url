<?php

namespace Slexx\Url;

class Path implements \Countable, \IteratorAggregate
{
    /**
     * @var array
     */
    protected static $patterns = [
        'id' => '[1-9][0-9]*',
        'int' => '-?[1-9][0-9]*',
        'float' => '-?[1-9][0-9]*\.[0-9]+',
        'number' => '-?[1-9][0-9]*(?:\.[0-9]+)?',
        'alpha' => '[a-z]+',
        'slug' => '[a-z0-9_\-]+'
    ];

    /**
     * @param string $name
     * @param string $pattern
     * @return void
     */
    public static function pattern($name, $pattern)
    {
        static::$patterns[$name] = $pattern;
    }

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
     * @param Path|string $rule
     * @param array [$patterns]
     * @return array|null
     * @example:
     * (new Path('users/5'))
     *     ->match('/users/[id]');
     * // -> ['id' => '5']
     *
     * (new Path('users/lexa'))
     *     ->match('users/[login:([a-z0-9\-_]+)]');
     * // -> ['login' => 'lexa']
     *
     * (new Path('users/lexa'))
     *     ->match('/users/[login]', ['login' => '[a-z0-9\-_]+']);
     * // -> ['login' => 'lexa']
     *
     * (new Path('posts/5/comments/34/edit'))
     *     ->match('/posts/[post:id]/comments/[comment:id]/[action:alpha]');
     * // -> ['post' => '5', 'comment' => '34', 'action' => 'edit']
     */
    public function match($rule, $patterns = [])
    {
        $patterns = array_merge(static::$patterns, $patterns);

        if ($rule instanceof self) {
            $parts = $rule->all();
        } else {
            $parts = explode('/', trim($rule, '/'));
        }

        $result = [];
        foreach($parts as $i => $part) {
            if (preg_match('/^\[([^:]+)(?::(.+))?\]$/', $part, $matches)) {
                $name = $matches[1];

                $pattern = null;
                if (isset($matches[2]) && !empty($matches[2])) {
                    if (isset($patterns[$name])) {
                        $pattern = $patterns[$name];
                    } else if (isset(static::$patterns[$matches[2]])) {
                        $pattern = static::$patterns[$matches[2]];
                    } else {
                        $pattern = $matches[2];
                    }
                    $pattern = '/^' . $pattern . '$/';
                }

                if ($pattern === null && isset(static::$patterns[$name])) {
                    $pattern = '/^' . static::$patterns[$name] . '$/';
                }

                if ($pattern && !preg_match($pattern, $this->get($i))) {
                    return null;
                }

                $result[$name] = $this->get($i);
            } else if ($part !== $this->get($i)) {
                return null;
            }
        }

        return $result;
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

