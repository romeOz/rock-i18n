Internationalization library for PHP
=================

[![Latest Stable Version](https://poser.pugx.org/romeOz/rock-i18n/v/stable.svg)](https://packagist.org/packages/romeOz/rock-i18n)
[![Total Downloads](https://poser.pugx.org/romeOz/rock-i18n/downloads.svg)](https://packagist.org/packages/romeOz/rock-i18n)
[![Build Status](https://travis-ci.org/romeOz/rock-i18n.svg?branch=master)](https://travis-ci.org/romeOz/rock-i18n)
[![HHVM Status](http://hhvm.h4cc.de/badge/romeoz/rock-i18n.svg)](http://hhvm.h4cc.de/package/romeoz/rock-i18n)
[![Coverage Status](https://coveralls.io/repos/romeOz/rock-i18n/badge.svg?branch=master)](https://coveralls.io/r/romeOz/rock-i18n?branch=master)
[![License](https://poser.pugx.org/romeOz/rock-i18n/license.svg)](https://packagist.org/packages/romeOz/rock-i18n)

[Rock Url on Packagist](https://packagist.org/packages/romeOz/rock-i18n)

Features
-------------------

 * Module for [Rock Framework](https://github.com/romeOz/rock)

Installation
-------------------

From the Command Line:

```composer require romeoz/rock-i18n:*```

In your composer.json:

```json
{
    "require": {
        "romeoz/rock-i18n": "*"
    }
}
```

Quick Start
-------------------

```php
use rock\i18n\i18n;

$i18n = new i18n;

$i18n->add('hello', 'Hello {{placeholder}}');

$i18n->translate('hello', ['placeholder' => 'world!']); // output: Hello world!

// or 

i18n::t('hello', ['placeholder' => 'Rock!']); // output: Hello Rock!
```

Documentation
-------------------

####addMulti(array $data)

Adds list i18-records as array.

```php
use rock\i18n\i18n;

$i18n = new i18n;

$i18n->addMulti([
    'en' => [                // locale
        'lang' => [         // category
            'hello' => 'Hello world!'
        ]
    ],
    'ru' => [
        'lang' => [
            'hello' => 'Привет мир!'
        ]
    ]
]);
```

####addDicts(array $dicts)

Adds dicts as paths.

```php
use rock\i18n\i18n;

$config = [
    'pathsDicts' => [ 
        'en' => [
                'path/to/en/lang.php',
                'path/to/en/validate.php',
            ]
        ]
     ]   
];
$i18n = new i18n($config);

// or

$paths = [ 
    'en' => [
         'path/to/en/lang.php',
         'path/to/en/validate.php',
     ]
];
$i18n->addDicts($paths);
```

###translate(string|array $keys, array $placeholders = [])

`$keys` can be a string, composite string (`months.nov`), or array (`['months', 'nov']`).

```php
$i18n->translate('hello');
```

###static t(string|array$keys, array $placeholders = [], $category = null, $locale = null)

Translation via the static method.

```php
i18n::t('hello');
```

###locale(string $locale)

Select locale.

```php
use rock\i18n\i18n;

$i18n = new i18n;
$i18n->locale('fr');
$i18n->translate('hello');
```

###category($category)

Select category.

```php
use rock\i18n\i18n;

$i18n = new i18n;
$i18n->locale('fr')->category('validate');
$i18n->translate('required');
```

Requirements
-------------------
 * **PHP 5.4+**

License
-------------------

Rock i18n library is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).