<?php

namespace App\Traits;

trait Done
{
    protected $done = false;

    protected $result;

    protected function done()
    {
        $this->done = true;
    }

    protected function unDone()
    {
        $this->done = false;

        $this->result = null;
    }
}
