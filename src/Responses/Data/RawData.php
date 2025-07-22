<?php

namespace Yzpeedro\ViacepHardcore\Responses\Data;

use ArrayAccess;
use InvalidArgumentException;
use JsonException;
use JsonSerializable;
use Override;
use Stringable;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

readonly class RawData implements Stringable, JsonSerializable, ArrayAccess
{
    use Makeable;

    public function __construct(
        public ?string $cep = null,
        public ?string $logradouro = null,
        public ?string $complemento = null,
        public ?string $unidade = null,
        public ?string $bairro = null,
        public ?string $localidade = null,
        public ?string $regiao = null,
        public ?string $uf = null,
        public ?string $estado = null,
        public ?string $ibge = null,
        public ?string $gia = null,
        public ?string $ddd = null,
        public ?string $siafi = null,
    ) {
    }

    /**
     * Gets the raw data as a JSON string.
     *
     * @throws JsonException
     */
    #[Override]
    public function jsonSerialize(): string
    {
        $vars = get_object_vars($this);
        return json_encode($vars, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    }

    #[Override]
    public function offsetExists(mixed $offset): bool
    {
        if (!is_string($offset)) {
            throw new InvalidArgumentException('Offset must be a string.');
        }

        return isset($this->$offset);
    }

    #[Override]
    public function offsetGet(mixed $offset): mixed
    {
        if (!is_string($offset)) {
            throw new InvalidArgumentException('Offset must be a string.');
        }

        if (!isset($this->$offset)) {
            return null;
        }

        return $this->$offset;
    }

    #[Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!is_string($offset)) {
            throw new InvalidArgumentException('Offset must be a string.');
        }

        if (!property_exists($this, $offset)) {
            throw new InvalidArgumentException("Property '$offset' does not exist in " . self::class);
        }

        $this->$offset = $value;
    }

    #[Override]
    public function offsetUnset(mixed $offset): void
    {
        if (!is_string($offset)) {
            throw new InvalidArgumentException('Offset must be a string.');
        }

        if (!property_exists($this, $offset)) {
            throw new InvalidArgumentException("Property '$offset' does not exist in " . self::class);
        }

        unset($this->$offset);
    }

    /**
     * Gets the raw data as a string.
     *
     * @throws JsonException
     */
    public function __toString(): string
    {
        return $this->jsonSerialize();
    }
}
