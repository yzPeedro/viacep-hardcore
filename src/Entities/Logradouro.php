<?php

namespace Yzpeedro\ViacepHardcore\Entities;

use Override;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\IsValid;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidLogradouroArgumentException;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Helpers\JsonSerializable;
use Yzpeedro\ViacepHardcore\Traits\Arrayable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class Logradouro extends Entity implements Fakecable, Gettable, Settable, IsValid
{
    use Faker;
    use Arrayable;
    use Makeable;
    use JsonSerializable;

    public function __construct(
        private string $logradouro = ''
    ) {
    }

    /**
     * Get a randomly generated Logradouro.
     *
     * @return string
     */
    #[Override]
    public static function fake(): string
    {
        $faker = (new self(''))->getInstance();
        return $faker->streetAddress;
    }

    /**
     * Get the Logradouro.
     *
     * @return string
     */
    #[Override]
    public function get(): string
    {
        return $this->logradouro;
    }

    /**
     * Get the value of Logradouro as a string.
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return $this->logradouro;
    }

    /**
     * Check if the Logradouro is valid.
     *
     * @return bool
     */
    #[Override]
    public function isValid(): bool
    {
        return !empty($this->logradouro);
    }

    /**
     * Set the Logradouro value.
     *
     * @param mixed $value
     * @return static
     * @throws InvalidLogradouroArgumentException
     */
    #[Override]
    public function set(mixed $value): static
    {
        $this->logradouro = (string) $value;

        if (! $this->isValid()) {
            throw new InvalidLogradouroArgumentException('Invalid Logradouro value.');
        }

        return $this;
    }
}
