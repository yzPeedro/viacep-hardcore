<?php

namespace Yzpeedro\ViacepHardcore\Entities;

use Override;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\IsValid;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidGiaArgumentException;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Traits\Arrayable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class Gia extends Entity implements Fakecable, Gettable, Settable, IsValid
{
    use Faker;
    use Arrayable;
    use Makeable;

    public const string PREFIX = 'GIA';

    public function __construct(
        private string $gia = ''
    ) {
    }

    /**
     * Get a randomly generated gia.
     *
     * @return string
     */
    #[Override]
    public static function fake(): string
    {
        $faker = (new self(''))->getInstance();

        return self::PREFIX . $faker->unique()->numerify('#########');
    }

    /**
     * Get the gia without the prefix.
     *
     * @return string
     */
    public function withoutPrefix(): string
    {
        return str_replace(self::PREFIX, '', $this->gia);
    }

    /**
     * Get the gia.
     *
     * @return string
     */
    #[Override]
    public function get(): string
    {
        return $this->gia;
    }

    /**
     * Get the value of gia as a string.
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return $this->gia;
    }

    /**
     * Check if the gia is valid.
     *
     * @return bool
     */
    #[Override]
    public function isValid(): bool
    {
        if (empty($this->gia)) {
            return false;
        }

        return preg_match('/^GIA\d{9}$/', $this->gia) === 1;
    }

    /**
     * Set the gia value.
     *
     * @param mixed $value
     * @return static
     * @throws InvalidGiaArgumentException
     */
    #[Override]
    public function set(mixed $value): static
    {
        $this->gia = $value;

        if (! $this->isValid()) {
            throw new InvalidGiaArgumentException('Invalid GIA value provided.');
        }

        return $this;
    }
}
