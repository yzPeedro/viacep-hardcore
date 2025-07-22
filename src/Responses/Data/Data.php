<?php

namespace Yzpeedro\ViacepHardcore\Responses\Data;

use ArrayAccess;
use InvalidArgumentException;
use JsonException;
use JsonSerializable;
use Override;
use Stringable;
use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Entities\Bairro;
use Yzpeedro\ViacepHardcore\Entities\CEP;
use Yzpeedro\ViacepHardcore\Entities\Complemento;
use Yzpeedro\ViacepHardcore\Entities\Gia;
use Yzpeedro\ViacepHardcore\Entities\IBGE;
use Yzpeedro\ViacepHardcore\Entities\Localidade;
use Yzpeedro\ViacepHardcore\Entities\Logradouro;
use Yzpeedro\ViacepHardcore\Entities\UF;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

readonly class Data implements Stringable, JsonSerializable, ArrayAccess
{
    use Makeable;

    public function __construct(
        public ?CEP $cep = null,
        public ?Logradouro $logradouro = null,
        public ?Complemento $complemento = null,
        public ?Bairro $bairro = null,
        public ?Localidade $localidade = null,
        public ?UF $uf = null,
        public ?IBGE $ibge = null,
        public ?Gia $gia = null,
    ) {
    }

    /**
     * Gets the response data as a string.
     *
     * @throws JsonException
     */
    #[Override]
    public function __toString(): string
    {
        return $this->jsonSerialize();
    }

    /**
     * Gets the response data as a JSON string.
     *
     * @return string
     * @throws JsonException
     */
    #[Override]
    public function jsonSerialize(): string
    {
        return json_encode(get_object_vars($this), JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    }

    #[Override]
    public function offsetExists(mixed $offset): bool
    {
        return property_exists($this, $offset);
    }

    #[Override]
    public function offsetGet(mixed $offset): mixed
    {
        if (! is_string($offset)) {
            throw new InvalidArgumentException("Offset must be a string, " . gettype($offset) . " given.");
        }

        if ($this->offsetExists($offset)) {
            return $this->{$offset};
        }

        return null;
    }

    #[Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (! is_string($offset)) {
            throw new InvalidArgumentException("Offset must be a string, " . gettype($offset) . " given.");
        }

        if ($value instanceof Entity) {
            throw new InvalidArgumentException("Value must be an ". Entity::class .", " . gettype($value) . " given.");
        }

        if (! $this->offsetExists($offset)) {
            throw new InvalidArgumentException("Property '$offset' does not exist in " . self::class);
        }

        $this->{$offset} = $value;
    }

    #[Override]
    public function offsetUnset(mixed $offset): void
    {
        if (! $this->offsetExists($offset)) {
            throw new InvalidArgumentException("Property '$offset' does not exist in " . self::class);
        }

        unset($this->{$offset});
    }
}
