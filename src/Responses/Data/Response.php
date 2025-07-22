<?php

namespace Yzpeedro\ViacepHardcore\Responses\Data;

use JsonException;
use JsonSerializable;
use Override;

readonly class Response implements JsonSerializable
{
    public function __construct(
        public bool $error,
        public int $status,
        public Data $data,
        public RawData $rawData
    ) {
    }

    /**
     * Gets the response data as a JSON string.
     *
     * @throws JsonException
     */
    #[Override]
    public function jsonSerialize(): string
    {
        $vars = get_object_vars($this);
        return json_encode($vars, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    }
}
