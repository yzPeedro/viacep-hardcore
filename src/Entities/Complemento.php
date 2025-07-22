<?php

namespace Yzpeedro\ViacepHardcore\Entities;

use Override;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\IsValid;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidComplementoArgument;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Traits\Arrayable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class Complemento extends Entity implements Fakecable, Gettable, Settable, IsValid
{
    use Faker;
    use Arrayable;
    use Makeable;

    public const array COMPLEMENTS = [
        'Apto.', 'Casa', 'Sala', 'Bloco', 'Edifício', 'Conjunto', 'Lote', 'Quadra'
    ];

    public function __construct(
        private string $complemento = ''
    ) {
    }

    /**
     * Get a randomly generated complemento.
     *
     * @return string
     */
    #[Override]
    public static function fake(): string
    {
        $faker = (new self(''))->getInstance();
        $number = $faker->numberBetween(1, 100);

        return $faker->randomElement(self::COMPLEMENTS) . ' ' . $number;
    }

    /**
     * Get the complemento.
     *
     * @return string
     */
    #[Override]
    public function get(): string
    {
        return $this->complemento;
    }

    /**
     * Get the value of complemento as a string.
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return $this->complemento;
    }

    /**
     * Check if the complemento is valid.
     *
     * @return bool
     */
    #[Override]
    public function isValid(): bool
    {
        return !empty($this->complemento);
    }

    /**
     * Set the complemento value.
     *
     * @param mixed $value
     * @return static
     * @throws InvalidComplementoArgument
     */
    #[Override]
    public function set(mixed $value): static
    {
        $this->complemento = (string) $value;

        if (! $this->isValid()) {
            throw new InvalidComplementoArgument("Invalid complemento argument: {$value}");
        }

        return $this;
    }
}
