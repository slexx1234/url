<?php

namespace Slexx\Url;

use Slexx\Pattern\Pattern;

class Url
{
    /**
     * Регулярка для парсинга URL, для проверки не
     * рекомендую её использовать, только для парсинга
     */
    const REGEX = '/^
        (?:(?P<scheme>[a-z][a-z\d\+\-\.]*):\/\/\/?)?
        (?:(?P<user>[^:@]+)(?:\:(?P<password>[^@]+))?@)?
        (?P<host>[^\:\/\?\#]+)?
        (?:\:(?P<port>\d+))?
        (?P<path>[^\?\#]+)?
        (?:\?(?P<query>[^\#]+))?
        (?:\#(?P<flag>.+))?
    $/ix';

    /**
     * @var string|null
     */
    protected $scheme = null;

    /**
     * @var Host
     */
    protected $host = null;

    /**
     * @var string|null
     */
    protected $port = null;

    /**
     * @var string|null
     */
    protected $user = null;

    /**
     * @var string|null
     */
    protected $password = null;

    /**
     * @var Path
     */
    protected $path = null;

    /**
     * @var Query
     */
    protected $query = null;

    /**
     * @var string|null
     */
    protected $flag = null;

    /**
     * @param string $url
     * @return array
     */
    public static function parse($url)
    {
        preg_match(self::REGEX, $url, $matches);

        return [
            'scheme' => isset($matches['scheme']) && !empty($matches['scheme']) ? $matches['scheme'] : null,
            'user' => isset($matches['user']) && !empty($matches['user']) ? $matches['user'] : null,
            'password' => isset($matches['password']) && !empty($matches['password']) ? $matches['password'] : null,
            'host' => isset($matches['host']) && !empty($matches['host']) ? $matches['host'] : null,
            'port' => isset($matches['port']) && !empty($matches['port']) ? (int) $matches['port'] : null,
            'path' => isset($matches['path']) && !empty($matches['path']) ? $matches['path'] : null,
            'query' => isset($matches['query']) && !empty($matches['query']) ? $matches['query'] : null,
            'flag' => isset($matches['flag']) && !empty($matches['flag']) ? $matches['flag'] : null,
        ];
    }

    /**
     * Url constructor.
     * @param string $url
     */
    public function __construct($url)
    {
        $parts = static::parse($url);

        $this->setScheme($parts['scheme']);
        $this->setHost($parts['host']);
        $this->setPort($parts['port']);
        $this->setUser($parts['user']);
        $this->setPassword($parts['password']);
        $this->setPath($parts['path']);
        $this->setQuery($parts['query']);
        $this->setFlag($parts['flag']);
    }

    /**
     * @param string|null $scheme
     * @return void
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
    }

    /**
     * @return string|null
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @param string|Host|null $host
     * @return void
     */
    public function setHost($host)
    {
        if ($host instanceof Host) {
            $this->host = $host;
        } else {
            $this->host = new Host($host);
        }
    }

    /**
     * @return Host
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param int|null $port
     * @return void
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return null|string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string|null $user
     * @return void
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return null|string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string|null $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return null|string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string|Path|null $path
     * @return void
     */
    public function setPath($path)
    {
        if ($path instanceof Path) {
            $this->path = $path;
        } else {
            $this->path = new Path($path);
        }
    }

    /**
     * @return Path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string|Query|null $query
     * @return void
     */
    public function setQuery($query)
    {
        if ($query instanceof Query) {
            $this->query = $query;
        } else {
            $this->query = new Query($query);
        }
    }

    /**
     * @return Query
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string|null $flag
     * @return void
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    }

    /**
     * @return null|string
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $host = (string) $this->host;
        return [
            'scheme' => $this->scheme,
            'host' => empty($host) ? null : $host,
            'port' => $this->port,
            'user' => $this->user,
            'password' => $this->password,
            'path' => count($this->path) === 0 ? null : (string) $this->path,
            'query' => count($this->query) === 0 ? null : (string) $this->query,
            'flag' => $this->flag,
        ];
    }

    /**
     * @param string $rule
     * @return array|null
     */
    public function match($rule)
    {
        $parts = static::parse($rule);
        $pattern = '';

        if ($parts['scheme'] !== null) {
            $pattern .= $parts['scheme'] . '://';
        } else if ($this->scheme !== null) {
            $pattern .= $this->scheme . '://';
        }

        if ($parts['host'] !== null) {
            $pattern .= $parts['host'];
        } else if (!empty((string) $this->host)) {
            $pattern .= $this->host . '://';
        }

        if ($parts['path'] !== null) {
            $pattern .= '/' . trim($parts['path'], '/') . '[/]';
        }

        return (new Pattern($pattern))->match(($this->scheme !== null ? $this->scheme . '://' : '') . $this->host . $this->path);
    }

    /**
     * @param string $rule
     * @return bool
     */
    public function is($rule)
    {
        return $this->match($rule) !== null;
    }

    /**
     * @return bool
     */
    public function isAbsolute()
    {
        return $this->scheme !== null
            && !empty((string) $this->host);
    }

    /**
     * @return bool
     */
    public function isRelative()
    {
        return !$this->isAbsolute();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $result = '';

        if ($this->scheme) {
            $result .= $this->scheme . '://';
        }

        if ($this->user) {
            $result .= $this->user;
            if ($this->password) {
                $result .= ':' . $this->password;
            }
            $result .= '@';
        }

        $result .= (string) $this->host;

        if ($this->port) {
            $result .= ':' . $this->port;
        }

        $result .= (string) $this->path;

        if (count($this->query)) {
            $result .= '?' . $this->query;
        }

        if ($this->flag) {
            $result .= '#' . $this->flag;
        }

        return $result;
    }

    /**
     * @return Url
     */
    public function __clone()
    {
        return new self($this->__toString());
    }
}


