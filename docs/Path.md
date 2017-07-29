Slexx\Url\Path
============================================

Оглавление
--------------------------------------------

* [Slexx\Url\Url](https://github.com/slexx1234/url/blob/master/docs/Url.md)
* [Slexx\Url\Host](https://github.com/slexx1234/url/blob/master/docs/Host.md)
* Slexx\Url\Path
* [Slexx\Url\Query](https://github.com/slexx1234/url/blob/master/docs/Query.md)

Методы
--------------------------------------------

### Path->__construct([$path])

**Аргументы:**

| Имя     | Тип      | Описание     |
| ------- | -------- | ------------ |
| `$path` | `string` | Путь запроса |

**Пример:**
```php
$path = new Path('/users/5/remove');
```

### Path->all()

Получение всех частей пути

**Возвращает:** `array`

**Пример:**
```php
$path = new Path('/users/5/remove');
var_dump($path->all());
// -> ['users', '5', 'remove']
```

### Path->count()

Подсщет колличества частей в пути

**Возвращает:** `int`

### Path->getIterator()

Позволяет перебирать переменные в цикле

**Возвращает:** `ArrayIterator`

**Пример:**

```php
$path = new Path('/users/5/remove');
foreach($path as $part) {
    // ...
}
```

### Path->get($index)

Возвращает часть пути по номеру или `null`

**Аргументы:**

| Имя      | Тип   | Описание         |
| -------- | ----- | ---------------- |
| `$index` | `int` | Номер части пути |

**Возвращает:** `string|null`

### Path->has($index)

Проверяет существование части пути по номеру

**Аргументы:**

| Имя      | Тип   | Описание         |
| -------- | ----- | ---------------- |
| `$index` | `int` | Номер части пути |

**Возвращает:** `bool`

### Path->set($index, $value)

Устанавливает часть пути

**Аргументы:**

| Имя      | Тип      | Описание         |
| -------- | -------- | ---------------- |
| `$index` | `int`    | Номер части пути |
| `$value` | `string` | Новая часть пути |

**Возвращает:** `void`

### Path->add($value)

Добовляет новую часть пути

**Аргументы:**

| Имя      | Тип      | Описание         |
| -------- | -------- | ---------------- |
| `$value` | `string` | Новая часть пути |

**Возвращает:** `void`

**Пример:**

```php
$path = new Path('users/5');
$path->add('edit');
var_dump(4path->all()); // -> ['users', '5', 'edit']
```

### Path->remove($index)

Удаляет часть пути по номеру

**Аргументы:**

| Имя      | Тип   | Описание         |
| -------- | ----- | ---------------- |
| `$index` | `int` | Номер части пути |

**Возвращает:** `void`

### Path->match($pattern)

Ищет совпадение шаблонов. Синтаксис шаблонов используется вида `<имя переменной>`.

**Аргументы:**

| Имя         | Тип      | Описание                           |
| ----------- | -------- | ---------------------------------- |
| `$pattern`  | `string` | Правило разбора пути               |

**Возвращает:** `array`, `null`

**Пример:**

```php
(new Path('users/5'))
    ->match('/users/<id:int>');
// -> ['id' => 5]

(new Path('users/alex1234'))
    ->match('users/<login:[a-z0-9\-_]+>');
// -> ['login' => 'alex1234']
    
(new Path('users/lexa'))
    ->match('/users/<login>');
// -> ['login' => 'lexa']

(new Path('posts/5/comments/34/edit'))
    ->match('/posts/<post:int>/comments/<comment:int>/<action>');
// -> ['post' => 5, 'comment' => 34, 'action' => 'edit']
```

### Path->__toString()

Преобразует объект в строку

**Возвращает:** `string`

**Пример:**

```php
$path = new Path('/users/5');
$path->add('edit');
echo $path; // -> '/users/5/edit'
```

### Path->__clone()

Клонирует объект

**Возвращает:** `Path`

