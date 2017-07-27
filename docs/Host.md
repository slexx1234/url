Slexx\Url\Host
============================================

Оглавление
--------------------------------------------


* [Slexx\Url\Url](https://github.com/slexx1234/url/blob/master/docs/Url.md)
* Slexx\Url\Host
* [Slexx\Url\Path](https://github.com/slexx1234/url/blob/master/docs/Path.md)
* [Slexx\Url\Query](https://github.com/slexx1234/url/blob/master/docs/Query.md)

Методы
--------------------------------------------

### Host->__construct($host)

**Аргументы:**

| Имя     | Тип      | Описание  |
| ------- | -------- | --------- |
| `$host` | `string` | Имя хоста |

**Пример:**

```php
$host1 = new Host('example.com');
$host2 = new Host('[::1]');
```

### Host->__toString()

Преобразует объект в строку

**Возвращает:** `string`

### Host->isIP()

Проверяет является ли хост IP адрессом

**Возвращает:** `bool`

**Пример:**

```php
var_dump((new Host('example.com'))->isIP()); // -> false
var_dump((new Host('[::1]'))->isIP()); // -> true
var_dump((new Host('192.0.2.235'))->isIP()); // -> true
```

### Host->isIPv4()

Проверяет является ли хост IPv4 адрессом

**Возвращает:** `bool`

**Пример:**

```php
var_dump((new Host('example.com'))->isIPv4()); // -> false
var_dump((new Host('[::1]'))->isIPv4()); // -> false
var_dump((new Host('192.0.2.235'))->isIPv4()); // -> true
```

### Host->isIPv6()

Проверяет является ли хост IPv6 адрессом

**Возвращает:** `bool`

**Пример:**

```php
var_dump((new Host('example.com'))->isIPv6()); // -> false
var_dump((new Host('[::1]'))->isIPv6()); // -> true
var_dump((new Host('192.0.2.235'))->isIPv6()); // -> false
```

### Host->isDomain()

Проверяет явлется ли имя хоста доменом

**Возвращает:** `bool`

**Пример:**

```php
var_dump((new Host('example.com'))->isDomain()); // -> true
var_dump((new Host('[::1]'))->isDomain()); // -> false
var_dump((new Host('192.0.2.235'))->isDomain()); // -> false
```

### Host->isSubdomain()

Проверяет явлется ли хост поддоменом

**Возвращает:** `bool`

**Пример:**

```php
var_dump((new Host('example.com'))->isSubdomain()); // -> false
var_dump((new Host('www.example.com'))->isSubdomain()); // -> true
```

### Host->__clone()

Клонирует объект

**Возвращает:** `Host`
