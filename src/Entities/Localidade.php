<?php

namespace Yzpeedro\ViacepHardcore\Entities;

use Override;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\IsValid;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidLocalidadeArgumentException;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Helpers\JsonSerializable;
use Yzpeedro\ViacepHardcore\Traits\Arrayable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class Localidade extends Entity implements Fakecable, Gettable, Settable, IsValid
{
    use Faker;
    use Arrayable;
    use Makeable;
    use JsonSerializable;

    public function __construct(
        private string $localidade = ''
    ) {
    }

    /**
     * Get a randomly generated localidade.
     *
     * @return string
     */
    #[Override]
    public static function fake(): string
    {
        $faker = (new self(''))->getInstance();
        return $faker->city();
    }

    /**
     * Get the localidade.
     *
     * @return string
     */
    #[Override]
    public function get(): string
    {
        return $this->localidade;
    }

    /**
     * Get the value of localidade as a string.
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return $this->localidade;
    }

    /**
     * Check if the localidade is valid.
     *
     * @return bool
     */
    #[Override]
    public function isValid(): bool
    {
        return !empty($this->localidade);
    }

    /**
     * Set the localidade value.
     *
     * @param mixed $value
     * @return static
     * @throws InvalidLocalidadeArgumentException
     */
    #[Override]
    public function set(mixed $value): static
    {
        $this->localidade = $value;

        if (! $this->isValid()) {
            throw new InvalidLocalidadeArgumentException('Invalid localidade value.');
        }

        return $this;
    }
}
