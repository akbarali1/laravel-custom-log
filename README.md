# laravel-custom-log

`config/logging.php` `channels` add
```php
'channels' => [
 ...
 
 'db' => [
        'driver' => 'rabbit_log',
        'via'    => RabbitLogger::class,
        'level'  => env('LOG_LEVEL', 'debug'),
    ],
]
```

`config/services.php` add
```php
'enableRabbitLog'   => env('ENABLE_RABBIT_LOG', false),
```
`.env` `ENABLE_RABBIT_LOG=true` added

`.env` change `LOG_CHANNEL=rabbit_log` added
