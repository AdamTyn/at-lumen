<?php

namespace App\Structs;

use App\Traits\Done;
use Illuminate\Contracts\Support\Arrayable;

class Message implements Arrayable
{
    use Done;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $content;

    public function __construct(string $code)
    {
        $this->setCode($code);
    }

    public function setCode(string $code)
    {
        $code = trim($code);

        if ($code != '') {
            $this->code = $code;

            $this->unDone();
        }

        return $this;
    }

    public function setContent(string $content)
    {
        $content = trim($content);

        if ($content != '') {
            $this->content = $content;

            $this->unDone();
        }

        return $this;
    }

    public function toArray(): array
    {
        if (!$this->done) {
            if ($this->content == '') {
                $this->content = codes($this->code);
            }

            $this->result = [$this->code, $this->content];

            $this->done();
        }

        return $this->result;
    }
}
