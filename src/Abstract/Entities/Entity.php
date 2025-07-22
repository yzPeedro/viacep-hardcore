<?php

namespace Yzpeedro\ViacepHardcore\Abstract\Entities;

use JsonSerializable;
use Override;
use Stringable;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

abstract class Entity implements JsonSerializable, Stringable, Fakecable
{
    use Faker;

    /**
     * Convert the class to its JSON representation.
     *
     * @return string
     */
    #[Override]
    public function jsonSerialize(): string
    {
        return (string) $this;
    }
}
