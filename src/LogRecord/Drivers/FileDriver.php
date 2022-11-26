<?php

namespace MohsenAbrishami\Stethoscope\LogRecord\Drivers;

use Illuminate\Support\Facades\Storage;
use MohsenAbrishami\Stethoscope\LogRecord\Contracts\LogRecordInterface;
use MohsenAbrishami\Stethoscope\Traits\MessageCreatorTrait;

class FileDriver implements LogRecordInterface
{
    use MessageCreatorTrait;

    public function record($cpuUsage, $memoryUsage, $networkStatus, $webServerStatuses, $hardDiskFreeSpace)
    {
        $file = config('stethoscope.log_file_storage.path') . now()->format('Y-m-d');

        $this->storage = Storage::disk(config('stethoscope.log_file_storage.driver'));

        $log = '';

        if ($cpuUsage > config(('stethoscope.thresholds.cpu')) && config('stethoscope.monitorable_resources.cpu'))
            $log .= $this->cpuMessage($cpuUsage) . "\n";

        if ($memoryUsage > config(('stethoscope.thresholds.memory')) && config('stethoscope.monitorable_resources.memory'))
            $log .= $this->memoryMessage($memoryUsage) . "\n";

        if (!$networkStatus && config('stethoscope.monitorable_resources.network'))
            $log .= $this->networkMessage($networkStatus) . "\n";

        if (($webServerStatuses['nginx'] != 'active' && config('stethoscope.monitorable_resources.web_server'))) {
            $log .= $this->webServerMessage('nginx', $webServerStatuses['nginx']) . "\n";
        }

        if (($webServerStatuses['apache'] != 'active' && config('stethoscope.monitorable_resources.web_server'))) {
            $log .= $this->webServerMessage('apache', $webServerStatuses['apache']) . "\n";
        }

        if ($hardDiskFreeSpace < config(('stethoscope.thresholds.hard_disk')) && config('stethoscope.monitorable_resources.hard_disk'))
            $log .= $this->hardDiskMessage($hardDiskFreeSpace) . "\n";

        if ($log != '') {
            $log = $this->timeMessage() . "\n" . $log;

            if ($this->storage->exists($file))
                $log = $this->storage->get($file) . "\n \n" . $log;

            $this->storage->put($file, $log);
        }
    }
}
