<?php

namespace Slexx\Url;

class Host
{
    /**
     * @var string
     */
    protected $host;

    /**
     * Host constructor.
     * @param string $host
     */
    public function __construct($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->host;
    }

    /**
     * @return boolean
     */
    public function isIP()
    {
        return $this->isIPv4()
            || $this->isIPv6();
    }

    /**
     * @return boolean
     */
    public function isIPv4()
    {
        return filter_var($this->host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }

    /**
     * @return boolean
     */
    public function isIPv6()
    {
        return $this->host[0] === '['
            && substr($this->host, -1) === ']'
            && filter_var(substr($this->host, 1, strlen($this->host) - 2), FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }

    /**
     * @return bool
     */
    public function isDomain()
    {
        return !$this->isIP();
    }

    /**
     * @return bool
     */
    public function isSubdomain()
    {
        return $this->isDomain()
            && substr_count($this->host, '.') > 1;
    }

    /**
     * @return Host
     */
    public function __clone()
    {
        return new self($this->__toString());
    }
}

