# Yii2 adapter for PHPMongo ODM

Yii Adapter for [PHPMongo ORM](https://github.com/sokil/php-mongo)

[![Total Downloads](http://img.shields.io/packagist/dt/phpmongokit/yii2-mongo-odm.svg)](https://packagist.org/packages/phpmongokit/yii2-mongo-odm)
[![Daily Downloads](https://poser.pugx.org/phpmongokit/yii2-mongo-odm/d/daily)](https://packagist.org/packages/phpmongokit/yii2-mongo-odm/stats)

Requirements
------------

* PHP 5
   * PHP 5.3 - PHP 5.6
  * [PHP Mongo Extension](https://pecl.php.net/package/mongo) 0.9 or above (Some features require >= 1.5)
* PHP 7 and HHVM
  * [PHP MongoDB Extension](https://pecl.php.net/package/mongodb) 1.0 or above
  * [Compatibility layer](https://github.com/alcaeus/mongo-php-adapter). Please, note some [restriontions](#compatibility-with-php-7)
  * HHVM Driver [not supported](https://derickrethans.nl/mongodb-hhvm.html).
* Tested over MongoDB v.2.4.12, v.2.6.9, v.3.0.2, v.3.2.10, v.3.3.15, v.3.4.0. See [Unit tests](#unit-tests) for details
<br/>

Installation
------------

You can install library through Composer:
```
composer require phpmongokit/yii2-mongo-odm
```

#### Compatibility with PHP 7

> PHPMongo currently based on old [ext-mongo](https://pecl.php.net/package/mongo) entension.
> To use this ODM with PHP 7, you need to add [compatibility layer](https://github.com/alcaeus/mongo-php-adapter), which implement API of old extension over new [ext-mongodb](https://pecl.php.net/package/mongodb).
> To start using PHPMongo with PHP7, add requirement [alcaeus/mongo-php-adapter](https://github.com/alcaeus/mongo-php-adapter) to composer.
> Restrictions for using ODM with compatibility layer you can read in [known issues](https://github.com/alcaeus/mongo-php-adapter#known-issues) of original adapter.

Library `sokil/php-mongo` depends from old `ext-mongo` so you need to require dependency with `--ignore-platform-reqs` flag:
```
composer require sokil/php-mongo --ignore-platform-reqs
```

Also you need to require adapter of old `ext-mongo` API to new `ext-mongodb`:
```
composer require alcaeus/mongo-php-adapter
```

Configuration of Client
-----------------------

```php
<?php

return array(
    'components' => array(
        // configure mongo service
        'mongo' => array(
            'class' => 'PHPMongoKit\ODM\Adapter\Yii2\Client',
            'dsn' => 'mongodb://127.0.0.1',
            'options' => array(
                'connect' => true,
                'readPreference' => \MongoClient::RP_SECONDARY_PREFERRED,
            ),
            'defaultDatabase' => 'database_name',
            'map' => array(
                'database_name' => array(
                    'collectionName1' => '\Collection\Class1',
                    'collectionName2' => '\Collection\Class2',
                )
            )
        ),
    )
);
```
