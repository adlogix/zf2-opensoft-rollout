Zend Framework 2 Module - Rollout
=======

[![Build Status](https://travis-ci.org/adlogix/zf2-opensoft-rollout.svg?branch=master)](https://travis-ci.org/adlogix/zf2-opensoft-rollout) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/adlogix/zf2-opensoft-rollout/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/adlogix/zf2-opensoft-rollout/?branch=master) [![Total Downloads](https://poser.pugx.org/adlogix/zf2-opensoft-rollout/downloads)](https://packagist.org/packages/adlogix/zf2-opensoft-rollout) [![License](https://poser.pugx.org/adlogix/zf2-opensoft-rollout/license)](https://packagist.org/packages/adlogix/zf2-opensoft-rollout) [![composer.lock](https://poser.pugx.org/adlogix/zf2-opensoft-rollout/composerlock)](https://packagist.org/packages/adlogix/zf2-opensoft-rollout) [![Latest Stable Version](https://poser.pugx.org/adlogix/zf2-opensoft-rollout/v/stable)](https://packagist.org/packages/adlogix/zf2-opensoft-rollout)

A ZF2 Module for [opensoft/rollout](https://github.com/opensoft/rollout)

# Installation

1. Install the module via composer by running:

```bash
composer require adlogix/zf2-opensoft-rollout:~1.0
```

2. Add the `Adlogix\Zf2Rollout` module to the module section of your `config/application.config.php`

# Configuration

Rollout parameters can be defined in the application configurations:

```php
<?php
return [
    'rollout' => [

        // Service id to obtain a Opensoft\Rollout\RolloutUserInterface instance
        'user_service' => null,

        // Service id to obtain a Opensoft\Rollout\Storage\StorageInterface instance
        'storage_service' => 'zf2_rollout_storage_array',

        // Required configuration if storage service is Adlogix\Zf2Rollout\Storage\ZendDbAdapterStorage
        'zend_db_storage' => [
            'table_name' => 'rollout_feature'
        ],

        // Required configuration if storage service is Adlogix\Zf2Rollout\Storage\Doctrine\DoctrineORMStorage
        'doctrine_storage' => [
            'class_name' => SomeFeatureEntity::class
        ]
    ],
]
```

# Usage

To retrieve the rollout service from a zend controller:

```
<?php

$rollout = $this->getServiceLocator()->get('zf2_rollout');
```

Refer to the documentation of [opensoft/rollout](https://github.com/opensoft/rollout) for more information on how to use the library.

## Zend Developer Toolbar

The module comes with support for the zend developer toolbar. Currently the toolbar only shows the list of features and enable status for a given user.

![zf2-adlogix-rollout zend developer tools](docs/rollout-zdt.png)
