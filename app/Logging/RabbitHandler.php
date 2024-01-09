<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger as Monolog;
use Monolog\LogRecord;
use Monolog\Processor\PsrLogMessageProcessor;
use Throwable;

class RabbitHandler extends AbstractProcessingHandler
{
    protected string $dateFormat = 'Y-m-d H:i:s';
    private array    $record;
    private Level    $levelName;

    /**
     * @inheritDoc
     */
    protected function write(LogRecord|array $record): void
    {
        $record    = is_array($record) ? $record : $record->toArray();
        $exception = $record['context']['exception'] ?? null;
        if ($exception instanceof Throwable) {
            $record['context']['exception'] = (string)$exception;
        }
        $this->record    = $record;

        $this->levelName = Level::fromName($this->record['level_name'] ?? 'error');
        if (config('services.enableRabbitLog') === true) {
            // custom code
            return;
        }

        $this->getDailyDriver();
    }

    private function getDailyDriver(): void
    {
        $formatter = new LineFormatter(null, $this->dateFormat, true, true);
        $daily     = new Monolog(app()->environment(), [], [new PsrLogMessageProcessor()]);
        $handler   = new RotatingFileHandler(storage_path('logs/laravel.log'), 15, $this->levelName);

        $handler->setFormatter($formatter);
        $daily->pushHandler($handler);

        $daily->addRecord(
            $this->levelName,
            $this->record['message'],
            $this->record['context'],
            $this->record['datetime']
        );
    }


}
