<?php

namespace MohsenAbrishami\Stethoscope\LogRecord\Drivers;

use Illuminate\Support\Facades\Storage;
use MohsenAbrishami\Stethoscope\LogRecord\Contracts\LogRecordInterface;
use MohsenAbrishami\Stethoscope\Traits\MessageCreatorTrait;
use Illuminate\Support\Str;

class FileDriver implements LogRecordInterface
{
    use MessageCreatorTrait;

    public function record($resourceReports)
    {
        $file = config('stethoscope.log_file_storage.path') . now()->format('Y-m-d');

        $this->storage = Storage::disk(config('stethoscope.log_file_storage.driver'));

        $log = '';

        foreach ($resourceReports as $resource => $resourceReport) {            
            $method = $resource . 'Message';

            if (method_exists($this, $method)) {
                $log .= $this->$method($resourceReport) . "\n";
            }
        }

        if ($log != '') {
            $log = $this->timeMessage() . "\n" . $log;

            if ($this->storage->exists($file))
                $log = $this->storage->get($file) . "\n \n" . $log;

            $this->storage->put($file, $log);
        }
    }
}
