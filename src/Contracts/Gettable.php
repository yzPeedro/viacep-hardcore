<?php

namespace Yzpeedro\ViacepHardcore\Contracts;

interface Gettable
{
    /**
     * Get the value of the object.
     *
     * @return mixed
     */
    public function get(): mixed;

    /**
     * Get the value of the object as a string.
     *
     * @return string
     */
    public function __toString(): string;
}
