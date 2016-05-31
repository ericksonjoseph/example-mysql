<?php

trait BenchmarkerTrait {

    private $logfile;

    private $timeStamps = [];

    private $memoryStamps = [];

    public function stampTime($note = '')
    {
        $t = $this->getMicrotime();
        $this->timeStamps[] = $t;
        $this->log($note . $t);
    }

    public function stampMemory($note = '')
    {
        $t = $this->getMemoryUsage();
        $this->memoryStamps[] = $t;
        $this->log($note . $this->convert($t));
    }

    private function getMemoryPeakUsage($float = true)
    {
        return memory_get_peak_usage($float);
    }

    private function getMemoryUsage($float = true)
    {
        return memory_get_usage($float);
    }

    private function getDateTime()
    {
        $now = new \DateTime();
        return $now->format('Y-m-d H:i:s');
    }

    private function getMicrotime($float = true)
    {
        return microtime($float);
    }

    private function convert($size)
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }

    private function log($msg){
        global $argv;

        $this->logfile = './stats.txt';

        $fmsg = $msg . PHP_EOL;
        file_put_contents($this->logfile, $fmsg, FILE_APPEND);
    }

    public function __destruct()
    {
        $totalMemory = end($this->memoryStamps) - reset($this->memoryStamps);
        $totalTime = end($this->timeStamps) - reset($this->timeStamps);
        $this->log('Time: ' . $totalTime);
        $this->log('Memory: ' . $this->convert($totalMemory));
    }
}
