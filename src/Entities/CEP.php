<?php

namespace Yzpeedro\ViacepHardcore\Entities;

use Override;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\IsValid;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidCepArgument;
use Yzpeedro\ViacepHardcore\Helpers\Faker;
use Yzpeedro\ViacepHardcore\Traits\Arrayable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class CEP extends Entity implements Fakecable, Gettable, Settable, IsValid
{
    use Arrayable;
    use Faker;
    use Makeable;

    public function __construct(
        private string $cep = ''
    ) {
    }

    /**
     * Get a randomly generated CEP.
     *
     * @return string
     */
    #[Override]
    public static function fake(): string
    {
        return (new self(''))->getInstance()->postcode();
    }

    /**
     * Get the CEP.
     *
     * @return string
     */
    #[Override]
    public function get(): string
    {
        return $this->cep;
    }

    /**
     * Get the value of CEP with mask.
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return $this->withMask();
    }

    /**
     * Get the value of cep without non-numeric characters.
     *
     * @return string
     */
    public function onlyNumbers(): string
    {
        return preg_replace('/\D/', '', $this->cep);
    }

    /**
     * Format the CEP with a mask (XXXXX-XXX).
     *
     * @return string
     */
    public function withMask(): string
    {
        return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $this->onlyNumbers());
    }

    /**
     * Validate the CEP format.
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return preg_match('/^\d{8}$/', $this->onlyNumbers()) === 1;
    }

    /**
     * Set the CEP value.
     *
     * @param mixed $value
     * @return static
     * @throws InvalidArgumentException
     */
    #[Override]
    public function set(mixed $value): static
    {
        if (! $this->isValid()) {
            throw new InvalidCepArgument("Invalid CEP argument: {$value}");
        }

        $this->cep = is_string($value) ? $value : (string) $value;
        return $this;
    }
}
