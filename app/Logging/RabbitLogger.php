<?php

namespace App\Logging;

use Monolog\Logger;

class RabbitLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @return Logger
     */
    public function __invoke(array $config): Logger
    {
        return new Logger('Rabbit Logs', [
            new DatabaseHandler(),
        ]);
    }

}
