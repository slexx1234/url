Headers
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

* [Slexx\Url\Url]()
* [Slexx\Url\Host]()
* [Slexx\Url\Path]()
* [Slexx\Url\Query]()
