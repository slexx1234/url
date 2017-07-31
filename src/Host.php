<?php

namespace Slexx\Url;

use Mso\IdnaConvert\IdnaConvert;

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
    public function __construct($host = null)
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

    /**
     * Проверяется указан ли хост в ASCII кодирокве
     * @return bool
     * @example:
     * (new Host('xn--tst-qla.de'))->isAscii(); // -> true
     * (new Host('täst.de'))->isAscii(); // -> false
     */
    public function isAscii()
    {
        return mb_detect_encoding($this->host, 'ASCII', true) === 'ASCII';
    }

    /**
     * Проверяет задоно ли имя хоста в Unicode кодировке
     * @return bool
     * @example:
     * (new Host('xn--tst-qla.de'))->isUnicode(); // -> false
     * (new Host('täst.de'))->isUnicode(); // -> true
     */
    public function isUnicode()
    {
        return !$this->isAscii();
    }

    /**
     * Проверяет является ли домен интернализированным
     * @return bool
     * @example:
     * (new Host('xn--tst-qla.de'))->isIdn(); // -> true
     * (new Host('täst.de'))->isIdn(); // -> true
     * (new Host('example.com'))->isIdn(); // -> false
     */
    public function isIdn()
    {
        return mb_strpos($this->host, 'xn--') === 0
            || !$this->isAscii();
    }

    /**
     * Преобразует имя хоста в ASCII кодировку
     * @return void
     * @example:
     * $host = new Host('täst.de');
     * $host->toAscii();
     * echo $host; // -> 'xn--tst-qla.de'
     */
    public function toAscii()
    {
        if ($this->isIdn() && $this->isUnicode())
            $this->host = (new IdnaConvert())->encode($this->host);
    }

    /**
     * Преобразует имя хоста в Unicode кодировку
     * @return void
     * @example:
     * $host = new Host('xn--tst-qla.de');
     * $host->toAscii();
     * echo $host; // -> 'täst.de'
     */
    public function toUnicode()
    {
        if ($this->isIdn() && $this->isAscii())
            $this->host = (new IdnaConvert())->decode($this->host);
    }
}

