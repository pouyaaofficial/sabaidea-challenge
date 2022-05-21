<?php

namespace Core;

abstract class JsonResource
{
    public function __construct(protected $data)
    {
    }

    public static function collection($data)
    {
        foreach ($data as $item) {
            $arr[] = (new static($item))->toArray();
        }

        return $arr;
    }

    abstract public function toArray(): array;
}
