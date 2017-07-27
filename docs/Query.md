Slexx\Url\Query
============================================

Оглавление
--------------------------------------------

* [Slexx\Url\Url](https://github.com/slexx1234/url/blob/master/docs/Url.md)
* [Slexx\Url\Host](https://github.com/slexx1234/url/blob/master/docs/Host.md)
* [Slexx\Url\Path](https://github.com/slexx1234/url/blob/master/docs/Path.md)
* Slexx\Url\Query

Методы
--------------------------------------------

### Query->__construct([$query])

**Аргуманты:**

| Имя      | Тип      | Описание       |
| -------- | -------- | -------------- |
| `$query` | `string` | Строка запроса |

**Пример:**

```php
$query = new Query('foo=bar');
```

### Query->all()

Получение массива всех переменных

**Возвращает:** `array`

**Пример:**

```php
$query = new Query('foo=bar');
print_r($query->all());
```

### Query->getIterator()

Позволяет перебирать переменные в цикле

**Возвращает:** `ArrayIterator`

**Пример:**

```php
foreach(new Query('foo=bar') as $name => $value) {
    echo "$name => $value<br>";
}
```

### Query->count()

**Возвращает:** `int` - Колличество переменных в запросе

### Query->has($key)

Проверяет есть ли переменная

**Аргументы:**

| Имя    | Тип      | Описание       |
| ------ | -------- | -------------- |
| `$key` | `string` | Имя переменной |

**Возвращает:** `bool`

### Query->get($key)

Получает значение переменной

**Аргументы:**

| Имя    | Тип      | Описание       |
| ------ | -------- | -------------- |
| `$key` | `string` | Имя переменной |

**Возвращает:** `mixed`

### Query->set($key, $value)

Устанавливает значение переменной

**Аргументы:**

| Имя      | Тип      | Описание            |
| -------- | -------- | ------------------- |
| `$key`   | `string` | Имя переменной      |
| `$value` | `mixed`  | Значение переменной |

**Возвращает:** `void`

### Query->remove($key)

Удаляет переменную

**Аргументы:**

| Имя    | Тип      | Описание       |
| ------ | -------- | -------------- |
| `$key` | `string` | Имя переменной |

**Возвращает:** `void`

### Query->__toString()

Преобразует класс в строку запроса

**Возвращает:** `string`

**Пример:**
```php
$query = new Query('foo=bar');
$query->set('bar', [
    'foo' => 'bar',
    'bar' => 'baz',
]);
echo $query; 

// -> foo=bar&bar[foo]=bar&bar[bar]=baz
```

### Query->__clone()

Клонирует объект

**Возвращает:** `Query`
