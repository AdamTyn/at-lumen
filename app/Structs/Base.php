<?php

namespace App\Structs;

use App\Traits\Done;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Pagination\LengthAwarePaginator;

class Base implements Arrayable, Jsonable
{
    use Done;

    /**
     * @var Message
     */
    protected $message;

    /**
     * @var Meta
     */
    protected $meta;

    /**
     * @var mixed
     */
    protected $data = null;

    public function __construct()
    {
        $this->meta = new Meta();

        $this->message = new Message('00200');
    }

    public function withCode(string $code)
    {
        $this->message->setCode($code);

        $this->unDone();

        return $this;
    }

    public function withMessage(string $message)
    {
        $this->message->setContent($message);

        $this->unDone();

        return $this;
    }

    public function withMeta(array $meta)
    {
        $this->meta->withExtra($meta);

        $this->unDone();

        return $this;
    }

    public function withData($data)
    {
        $this->data = $data;

        $this->unDone();

        return $this;
    }

    public function toArray(): array
    {
        if (!$this->done) {
            if ($this->data instanceof LengthAwarePaginator) {
                $data = Paginate::render($this->data);
            } else if ($this->data instanceof Arrayable) {
                $data = $this->data->toArray();
            } else {
                $data = $this->data;
            }

            $meta = $this->meta->toArray();

            list($code, $message) = $this->message->toArray();

            $this->result = compact('code', 'message', 'meta', 'data');

            $this->done();
        }

        return $this->result;
    }

    public function toJson($options = 0): string
    {
        return to_json($this->toArray());
    }
}
