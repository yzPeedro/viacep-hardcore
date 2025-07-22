<?php

namespace Yzpeedro\ViacepHardcore\Entities;

use Override;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\IsValid;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidUnidadeArgumentException;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Helpers\JsonSerializable;
use Yzpeedro\ViacepHardcore\Traits\Arrayable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class Unidade extends Entity implements Fakecable, Gettable, Settable, IsValid
{
    use Faker;
    use Arrayable;
    use Makeable;
    use JsonSerializable;

    public function __construct(
        private string $unidade = ''
    ) {
    }

    /**
     * Get a randomly generated unidade.
     *
     * @return string
     */
    #[Override]
    public static function fake(): string
    {
        $faker = (new self(''))->getInstance();

        return $faker->unique()->companySuffix();
    }

    /**
     * Get the unidade.
     *
     * @return string
     */
    #[Override]
    public function get(): string
    {
        return $this->unidade;
    }

    /**
     * Get the value of unidade as a string.
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return $this->unidade;
    }

    /**
     * Check if the unidade is valid.
     *
     * @return bool
     */
    #[Override]
    public function isValid(): bool
    {
        return !empty($this->unidade) && is_string($this->unidade);
    }

    /**
     * Set the unidade value.
     *
     * @param mixed $value
     * @return static
     * @throws InvalidUnidadeArgumentException
     */
    #[Override]
    public function set(mixed $value): static
    {
        if (!$this->isValid()) {
            throw new InvalidUnidadeArgumentException('Invalid unidade value.');
        }

        $this->unidade = (string)$value;
        return $this;
    }


}
