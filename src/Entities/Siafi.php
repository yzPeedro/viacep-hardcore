<?php

namespace Yzpeedro\ViacepHardcore\Entities;

use Override;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\IsValid;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidSiafiArgumentException;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Helpers\JsonSerializable;
use Yzpeedro\ViacepHardcore\Traits\Arrayable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class Siafi extends Entity implements Fakecable, Gettable, Settable, IsValid
{
    use Faker;
    use Arrayable;
    use Makeable;
    use JsonSerializable;

    public function __construct(
        private string $siafi = ''
    ) {
    }

    /**
     * Get a randomly generated siafi.
     *
     * @return string
     */
    #[Override]
    public static function fake(): string
    {
        $faker = (new self(''))->getInstance();
        $siafi = $faker->numberBetween(1000, 9999);

        return str_pad($siafi, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get the siafi.
     *
     * @return string
     */
    #[Override]
    public function get(): string
    {
        return $this->siafi;
    }

    /**
     * Get the value of siafi as a string.
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return $this->siafi;
    }

    /**
     * Check if the siafi is valid.
     *
     * @return bool
     */
    #[Override]
    public function isValid(): bool
    {
        if (empty($this->siafi)) {
            return false;
        }

        return preg_match('/^\d{4}$/', $this->siafi) === 1;
    }

    /**
     * Set the siafi value.
     *
     * @param mixed $value
     * @return static
     * @throws InvalidSiafiArgumentException
     */
    #[Override]
    public function set(mixed $value): static
    {
        $this->siafi = str_pad((string)$value, 4, '0', STR_PAD_LEFT);

        if (! $this->isValid()) {
            throw new InvalidSiafiArgumentException('Invalid Siafi value.');
        }

        return $this;
    }
}
