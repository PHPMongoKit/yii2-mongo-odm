# Yii2 adapter for PHPMongo ODM


Yii Adapter for [PHPMongo ORM](https://github.com/sokil/php-mongo)

Installation
------------

You can install library through Composer:
```
composer require phpmongokit/yii2-mongo-odm
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
