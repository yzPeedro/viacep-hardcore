<?php

namespace Yzpeedro\ViacepHardcore\Entities;

use Override;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\IsValid;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidUFArgumentException;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Helpers\JsonSerializable;
use Yzpeedro\ViacepHardcore\Traits\Arrayable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class UF extends Entity implements Fakecable, Gettable, Settable, IsValid
{
    use Faker;
    use Arrayable;
    use Makeable;
    use JsonSerializable;

    public function __construct(
        private string $uf = ''
    ) {
    }

    /**
     * Get a randomly generated uf.
     *
     * @return string
     */
    #[Override]
    public static function fake(): string
    {
        $faker = (new self(''))->getInstance();
        return strtoupper($faker->randomLetter() . $faker->randomLetter());
    }

    /**
     * Get the uf.
     *
     * @return string
     */
    #[Override]
    public function get(): string
    {
        return strtoupper($this->uf);
    }

    /**
     * Get the value of uf as a string.
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return strtoupper($this->uf);
    }

    /**
     * Check if the uf is valid.
     *
     * @return bool
     */
    #[Override]
    public function isValid(): bool
    {
        if (strlen($this->uf) !== 2 || !ctype_alpha($this->uf)) {
            return false;
        }

        return preg_match('/^[A-Z]{2}$/', $this->uf) === 1;
    }

    /**
     * Check if the uf is valid.
     *
     * @param mixed $value
     * @return UF
     * @throws InvalidUFArgumentException
     */
    #[Override]
    public function set(mixed $value): static
    {
        if (! $this->isValid()) {
            throw new InvalidUFArgumentException('Invalid UF value.');
        }

        $this->uf = strtoupper($value);
        return $this;
    }


}
