Yii2 PaperTrail logging
=========

This allows your Yii application to send its log messages to [PaperTrail servers](https://papertrailapp.com/)

Example Configuration
----------
```php
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'fernandezekiel\papertrail\PaperTrail',
                    'levels' => ['error', 'warning'],
                    'url' => 'logs.papertrailapp.com',
                    'port' => 99999
                ],
            ],
        ],
    ...
```