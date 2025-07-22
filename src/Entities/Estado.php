<?php

namespace Yzpeedro\ViacepHardcore\Entities;

use Override;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\IsValid;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidEstadoArgumentException;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Helpers\JsonSerializable;
use Yzpeedro\ViacepHardcore\Traits\Arrayable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class Estado extends Entity implements Fakecable, Gettable, Settable, IsValid
{
    use Faker;
    use Arrayable;
    use Makeable;
    use JsonSerializable;

    public function __construct(
        private string $estado = ''
    ) {
    }

    /**
     * Get a randomly generated estado.
     *
     * @return string
     */
    #[Override]
    public static function fake(): string
    {
        $faker = (new self(''))->getInstance();
        return ucfirst($faker->word());
    }

    /**
     * Get the estado.
     *
     * @return string
     */
    #[Override]
    public function get(): string
    {
        return $this->estado;
    }

    /**
     * Get the value of estado as a string.
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return $this->estado;
    }

    /**
     * Check if the estado is valid.
     *
     * @return bool
     */
    #[Override]
    public function isValid(): bool
    {
        return !empty($this->estado) && is_string($this->estado);
    }

    /**
     * Set the estado value.
     *
     * @param mixed $value
     * @return static
     * @throws InvalidArgumentException
     */
    #[Override]
    public function set(mixed $value): static
    {
        $this->estado = (string) $value;

        if (! $this->isValid()) {
            throw new InvalidEstadoArgumentException('Invalid estado value');
        }

        return $this;
    }
}
