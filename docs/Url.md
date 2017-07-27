Slexx\Url\Url 
============================================

Оглавление
--------------------------------------------

* Slexx\Url\Url
* [Slexx\Url\Host](https://github.com/slexx1234/url/blob/master/docs/Host.md)
* [Slexx\Url\Path](https://github.com/slexx1234/url/blob/master/docs/Path.md)
* [Slexx\Url\Query](https://github.com/slexx1234/url/blob/master/docs/Query.md)

Методы
--------------------------------------------

### Url->__construct($url)

**Аргументы:**

| Имя    | Тип      | Описание            |
| ------ | -------- | ------------------- |
| `$url` | `string` | Валидный URL адресс |

**Пример:**

```php
$url = new Url('http://username:password@hostname:9090/path?arg=value#anchor');
```

### Url::parse($url)

Разбивает URL а отдельные компоненты и возвращает их в виде массива

**Аргументы:**

| Имя    | Тип      | Описание            |
| ------ | -------- | ------------------- |
| `$url` | `string` | Валидный URL адресс |

**Возвращает:** `array`

**Пример:**

```php
var_dump(Url::parse('http://username:password@hostname:9090/path?arg=value#anchor'));
/*
[
    'scheme' => 'http',
    'user' => 'username',
    'password' => 'password',
    'host' => 'hostname',
    'port' => 9090,
    'path' => '/path',
    'query' => 'arg=value',
    'flag' => 'anchor',
]
*/
```

### Url->setScheme($scheme)

Устанавливает схему URL

**Аргументы:**

| Имя       | Тип              | Описание                    |
| --------- | ---------------- | --------------------------- |
| `$scheme` | `string`, `null` | Схема URL - http, file, ftp |

**Возвращает:** `void`

### Url->getScheme()

Возвращает схему URL

**Возвращает:** `string`, `null`

### Url->setHost($host)

Устанавливает имя хоста

**Аргументы:**

| Имя     | Тип                      | Описание  |
| ------- | ------------------------ | --------- |
| `$host` | `string`, `Host`, `null` | Имя хоста |

### Url->getHost()

Возвращает имя хоста

**Возвращает:** `Host`

### Url->setPort($port)

Устанавливает порт

**Аргументы:**

| Имя     | Тип           | Описание    |
| ------- | ------------- | ----------- |
| `$post` | `int`, `null` | Номер порта |

**Возвращает:** `void`

### Url->getPort()

Вовращает порт

**Возвращает:** `null|int`

### Url->setUser($user)

Устанавливает имя пользователя

**Аргументы:**

| Имя     | Тип              | Описание         |
| ------- | ---------------- | ---------------- |
| `$user` | `string`, `null` | Имя пользователя |

**Возвращает:** `void`

### Url->getUser()

Возвращает имя пользователя

**Возвращает:** `null|string`

### Url->setPassword($password)

Устанавливает пароль

**Аргументы:**

| Имя         | Тип              | Описание     |
| ----------- | ---------------- | ------------ |
| `$password` | `string`, `null` | Новый пароль |

**Возвращает:** `void`

### Url->getPassword()

Возвращает пароль

**Возвращает:** `null|string`

### Url->setPath($path)

Устанавливает путь URL

**Аргументы:**

| Имя     | Тип                      | Описание     |
| ------- | ------------------------ | ------------ |
| `$path` | `string`, `null`, `Path` | Путь запроса |

**Возвращает:** `void`

### Url->getPath()

Возвращает путь URL

**Возвращает:** `Path`

### Url->setQuery($query)

Устанавливает параметры запроса

**Аргументы:**

| Имя      | Тип                       | Описание       |
| -------- | ------------------------- | -------------- |
| `$query` | `string`, `null`, `Query` | Строка запроса |

**Возвращает:** `void`

### Url->getQuery()

Возвращает параметры запроса

**Возвращает:** `Query`

### Url->setFlag($flag)

Устанавливает якорь

**Аргументы:**

| Имя     | Тип              | Описание    |
| ------- | ---------------- | ----------- |
| `$flag` | `string`, `null` | Новый якорь |

**Возвращает:** `void`

### Url->getFlag()

Возвращает якорь

**Возвращает:** `null`, `string`

### Url->toArray()

Преобразует объект в массив

**Возвращает:** `array`

**Пример:**

```php
var_dump((new Url('http://username:password@hostname:9090/path?arg=value#anchor'))->toArray());
/*
[
    'scheme' => 'http',
    'user' => 'username',
    'password' => 'password',
    'host' => 'hostname',
    'port' => 9090,
    'path' => '/path',
    'query' => 'arg=value',
    'flag' => 'anchor',
]
*/
```

### Url->match($rule[, $patterns])

Метод работает на основе метода [Host->match](https://github.com/slexx1234/url/blob/master/docs/Path.md#path-matchrule-patterns), он проверяет не только путь запроса, но ещё и схему url и имя хоста.

**Аргументы:**

| Имя         | Тип      | Описание                           |
| ----------- | -------- | ---------------------------------- |
| `$rule`     | `string` | Правило разбора пути               |
| `$patterns` | `array`  | Подправила для проверки переменных |

**Возвращает:** `array`, `null`

**Пример:**

```php
$url = new Url('https://example.com/users/5/edit');

var_dump($url->match('https://')); // -> []
var_dump($url->match('http://example.com')); // -> null
var_dump($url->match('https://example.com/posts')); // -> null
var_dump($url->match('https://example.com/users/[id]/[controller]')); // -> ['id' => '5', 'controller' => 'edit']
```

### Url->is($rule)

Проверяет соотвецтвует URL правилу

**Аргументы:**

| Имя     | Тип      | Описание             |
| ------- | -------- | -------------------- |
| `$rule` | `string` | Правило для проверки |

**Возвращает:** `bool`

**Пример:**

```php
$url = new Url('https://example.com/users/5/edit');

var_dump($url->is('https://')); // -> true
var_dump($url->is('http://example.com')); // -> false
var_dump($url->is('https://example.com/posts')); // -> false
var_dump($url->is('https://example.com/users/[id]/[controller]')); true
```

### Url->isAbsolute()

Проверяет является ли URL абсолютным

**Возвращает:** `bool`

**Пример:**

```php
var_dump((new Url('https://example.com/users/5/edit'))->isAbsolute()); // -> true
var_dump((new Url('example.com/users/5/edit'))->isAbsolute()); // -> false
```

### Url->isRelative()

Проверяет является ли URL относительным

**Возвращает:** `bool`

**Пример:**

```php
var_dump((new Url('https://example.com/users/5/edit'))->isRelative()); // -> false
var_dump((new Url('example.com/users/5/edit'))->isRelative()); // -> true
```

### Url->__toString()

Преобразует объект в строку

**Возвращает:** `string`

**Пример:**

```php
$url = new Url('http://example.com:80/users/5/edit');
$url->setScheme('https');
$url->setPort(433);
echo $url; // -> https://example.com:433/users/5/edit
```

### Url->__clone()

Клонирует объект

**Возвращает:** `Url`
