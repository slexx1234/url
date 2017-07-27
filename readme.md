Url
=========================================
[![Latest Stable Version](https://poser.pugx.org/slexx/url/v/stable)](https://packagist.org/packages/slexx/url) [![Total Downloads](https://poser.pugx.org/slexx/url/downloads)](https://packagist.org/packages/slexx/url) [![Latest Unstable Version](https://poser.pugx.org/slexx/url/v/unstable)](https://packagist.org/packages/slexx/url) [![License](https://poser.pugx.org/slexx/url/license)](https://packagist.org/packages/slexx/url)

## Установка

```
$ composer require slexx/url
```

## Базовое использование

Класс для парсинга и манипуляцией ссылками

```php
$url = new Slexx\Url\Url('http://example.com/?arg=value');

echo $url->getHost();
// -> example.com
```

## Документация

* [Slexx\Url\Url](https://github.com/slexx1234/url/blob/master/docs/Url.md)
* [Slexx\Url\Host](https://github.com/slexx1234/url/blob/master/docs/Host.md)
* [Slexx\Url\Path](https://github.com/slexx1234/url/blob/master/docs/Path.md)
* [Slexx\Url\Query](https://github.com/slexx1234/url/blob/master/docs/Query.md)
