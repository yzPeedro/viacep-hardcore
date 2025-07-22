<?php

namespace Yzpeedro\ViacepHardcore\Entities;

use Override;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\IsValid;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidBairroArgument;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Traits\Arrayable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class Bairro extends Entity implements Fakecable, Gettable, Settable, IsValid
{
    use Faker;
    use Arrayable;
    use Makeable;

    public function __construct(
        private string $bairro = ''
    ) {
    }

    /**
     * Get a randomly generated bairro.
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
     * Get the bairro.
     *
     * @return string
     */
    #[Override]
    public function get(): string
    {
        return $this->bairro;
    }

    /**
     * Get the value of bairro as a string.
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return $this->bairro;
    }

    /**
     * Check if the bairro is valid.
     *
     * @return bool
     */
    #[Override]
    public function isValid(): bool
    {
        return !empty($this->bairro) && is_string($this->bairro);
    }

    /**
     * Set the bairro value.
     *
     * @param mixed $value
     * @return static
     * @throws InvalidBairroArgument
     */
    #[Override]
    public function set(mixed $value): static
    {
        if (! $this->isValid()) {
            throw new InvalidBairroArgument("Invalid Bairro value: " . (is_string($value) ? $value : ''));
        }

        $this->bairro = $value;
        return $this;
    }
}
