<?php

namespace Yzpeedro\ViacepHardcore\Contracts;

interface Settable
{
    /**
     * Set a value for entity.
     *
     * @param mixed $value
     * @return static
     */
    public function set(mixed $value): static;
}
