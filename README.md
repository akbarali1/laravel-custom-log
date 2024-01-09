# laravel-custom-log

`config/logging.php` `channels` add
```php
'channels' => [
 ...
 
 'db' => [
        'driver' => 'custom',
        'via'    => DatabaseLogger::class,
        'level'  => env('LOG_LEVEL', 'debug'),
    ],
]
```

`config/services.php` add
```php
'enableRabbitLog'   => env('ENABLE_RABBIT_LOG', false),
```
`.env` `ENABLE_RABBIT_LOG=true` added