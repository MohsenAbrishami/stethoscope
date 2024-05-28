<?php

namespace MohsenAbrishami\Stethoscope\LogRecord\Drivers;

use Illuminate\Support\Facades\Storage;
use MohsenAbrishami\Stethoscope\LogRecord\Contracts\LogRecordInterface;
use MohsenAbrishami\Stethoscope\Traits\MessageCreatorTrait;

class FileDriver implements LogRecordInterface
{
    use MessageCreatorTrait;

    public $storage;

    public function __construct()
    {
        $this->storage = Storage::disk(config('stethoscope.log_file_storage.driver'));
    }

    public function record($logs)
    {
        $file = config('stethoscope.log_file_storage.path').now()->format('Y-m-d');

        $log = '';

        foreach ($logs as $resource => $report) {
            $method = $resource.'Message';

            if (method_exists($this, $method)) {
                $log .= $this->$method($report)."\n";
            }
        }

        if ($log != '') {
            $log = $this->timeMessage()."\n".$log;

            if ($this->storage->exists($file)) {
                $log = $this->storage->get($file)."\n \n".$log;
            }

            $this->storage->put($file, $log);
        }
    }

    public function clean()
    {
        $this->storage->deleteDirectory(config('stethoscope.log_file_storage.path'));
    }
}
