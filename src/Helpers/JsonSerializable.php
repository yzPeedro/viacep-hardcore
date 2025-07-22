<?php

namespace Yzpeedro\ViacepHardcore\Helpers;

use JsonSerializable as JsonSerializableBase;
use Override;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;

/**
 * @mixin Gettable
 * @implements JsonSerializableBase
 */
trait JsonSerializable
{
    /**
     * Convert the object to its JSON representation.
     *
     * @return string
     * @Override
     */
    public function jsonSerialize(): string
    {
        return (string) $this;
    }
}
