<?php

namespace App\Structs;

use App\Traits\Done;
use Illuminate\Contracts\Support\Arrayable;

class Meta implements Arrayable
{
    use Done;

    /**
     * @var int
     */
    protected $serverUnix;

    /**
     * @var array
     */
    protected $extra = [];

    public function __construct(array $extra = [])
    {
        $this->serverUnix = time();

        $this->withExtra($extra);
    }

    public function withExtra(array $extra)
    {
        if (count($extra) > 0) {
            $this->extra += $extra;

            $this->unDone();
        }

        return $this;
    }

    public function toArray(): array
    {
        if (!$this->done) {
            $data = [
                'server_unix' => $this->serverUnix
            ];

            $this->result = $data + $this->extra;

            $this->done();
        }

        return $this->result;
    }
}
