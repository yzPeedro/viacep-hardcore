<?php

namespace Yzpeedro\ViacepHardcore\Entities;

use Override;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\IsValid;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidRegiaoArgumentException;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Helpers\JsonSerializable;
use Yzpeedro\ViacepHardcore\Traits\Arrayable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class Regiao extends Entity implements Fakecable, Gettable, Settable, IsValid
{
    use Faker;
    use Arrayable;
    use Makeable;
    use JsonSerializable;

    public function __construct(
        private string $regiao = '',
    ) {
    }

    /**
     * Get a randomly generated regiao.
     *
     * @return string
     */
    #[Override]
    public static function fake(): string
    {
        $faker = (new self(''))->getInstance();
        return ucfirst($faker->region());
    }

    /**
     * Get the regiao.
     *
     * @return string
     */
    #[Override]
    public function get(): string
    {
        return $this->regiao;
    }

    /**
     * Get the value of regiao as a string.
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return $this->regiao;
    }

    /**
     * Check if the regiao is valid.
     *
     * @return bool
     */
    #[Override]
    public function isValid(): bool
    {
        return !empty($this->regiao) && is_string($this->regiao);
    }

    /**
     * Set the regiao value.
     *
     * @param mixed $value
     * @return static
     * @throws InvalidRegiaoArgumentException
     */
    #[Override]
    public function set(mixed $value): static
    {
        $this->regiao = $value;

        if (! $this->isValid()) {
            throw new InvalidRegiaoArgumentException("Invalid regiao value provided.");
        }

        return $this;
    }
}
