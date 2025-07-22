<?php

namespace Yzpeedro\ViacepHardcore\Traits;

trait Arrayable
{
    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * Convert the object to a JSON string.
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
