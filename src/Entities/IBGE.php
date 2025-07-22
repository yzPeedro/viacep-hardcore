<?php

namespace Yzpeedro\ViacepHardcore\Entities;

use Override;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\IsValid;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidIBGEArgumentException;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Helpers\JsonSerializable;
use Yzpeedro\ViacepHardcore\Traits\Arrayable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class IBGE extends Entity implements Fakecable, Gettable, Settable, IsValid
{
    use Faker;
    use Arrayable;
    use Makeable;
    use JsonSerializable;

    public function __construct(
        private string $ibge = ''
    ) {
    }

    /**
     * Get a randomly generated ibge.
     *
     * @return string
     */
    #[Override]
    public static function fake(): string
    {
        $faker = (new self(''))->getInstance();
        return $faker->numerify('#########');
    }

    /**
     * Get the ibge.
     *
     * @return string
     */
    #[Override]
    public function get(): string
    {
        return $this->ibge;
    }

    /**
     * Get the value of ibge as a string.
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return $this->ibge;
    }

    /**
     * Check if the IBGE code is valid.
     *
     * @return bool
     */
    #[Override]
    public function isValid(): bool
    {
        if (empty($this->ibge)) {
            return false;
        }

        return preg_match('/^\d{8}$/', $this->ibge) === 1;
    }

    /**
     * Set the value of ibge.
     *
     * @param mixed $value
     * @return static
     * @throws InvalidIBGEArgumentException
     */
    #[Override]
    public function set(mixed $value): static
    {
        $this->ibge = $value;

        if (! $this->isValid()) {
            throw new InvalidIBGEArgumentException('Invalid IBGE code.');
        }

        return $this;
    }
}
