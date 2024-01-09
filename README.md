# laravel-custom-log

`config/logging.php` `channels` add
```php
'channels' => [
 ...
 
 'db' => [
        'driver' => 'rabbit',
        'via'    => RabbitLogger::class,
        'level'  => env('LOG_LEVEL', 'debug'),
    ],
]
```

`config/services.php` add
```php
'enableRabbitLog'   => env('ENABLE_RABBIT_LOG', false),
```
`.env` added  `ENABLE_RABBIT_LOG=true` and `LOG_CHANNEL=rabbit` change  
