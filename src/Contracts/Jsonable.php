<?php

namespace Yzpeedro\ViacepHardcore\Contracts;

interface Jsonable
{
    /**
     * Converts the object to a JSON string.
     *
     * @return string
     */
    public function toJson(): string;
}
