<?php

namespace App\Structs;

use App\Traits\Done;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Pagination\LengthAwarePaginator;

class Paginate implements Arrayable
{
    use Done;

    /**
     * @var LengthAwarePaginator
     */
    protected $resource;

    public function __construct(LengthAwarePaginator $resource)
    {
        $this->resource = $resource;
    }

    public static function render(LengthAwarePaginator $resource)
    {
        return (new static($resource))->toArray();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        if (!$this->done) {
            $this->result = [
                'scroll' => $this->resource->hasMorePages(),
                'pagination' => [
                    'total' => $this->resource->total(),
                    'count' => $this->resource->count(),
                    'per_page' => $this->resource->perPage(),
                    'current_page' => $this->resource->currentPage(),
                    'last_page' => $this->resource->lastPage()
                ],
                'list' => $this->resource->items()
            ];

            $this->done();
        }

        return $this->result;
    }
}
