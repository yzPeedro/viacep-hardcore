<?php

namespace Yzpeedro\ViacepHardcore;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Yzpeedro\ViacepHardcore\Entities\CEP;
use Yzpeedro\ViacepHardcore\Exceptions\InvalidCepArgument;
use Yzpeedro\ViacepHardcore\Responses\CompleteResponse;
use Yzpeedro\ViacepHardcore\Responses\Data\Data;
use Yzpeedro\ViacepHardcore\Responses\Data\RawData;
use Yzpeedro\ViacepHardcore\Responses\Data\Response;
use Yzpeedro\ViacepHardcore\Traits\Makeable;

class Viacep
{
    use Makeable;

    public const string JSON_API_URL = 'https://viacep.com.br/ws/%s/json/';

    public const string XML_API_URL = 'https://viacep.com.br/ws/%s/xml/';

    public function __construct(
        private string|CEP $cep = '',
    ) {
        if (is_string($cep)) {
            $this->cep = new CEP($cep);
        }

        if (!$this->cep->isValid()) {
            throw new InvalidCepArgument("Invalid CEP argument: $this->cep");
        }
    }

    /**
     * Fetches the address data from the ViaCEP API.
     *
     * @param bool $returnsRequest
     * @return ResponseInterface|array The address data.
     * @throws GuzzleException
     */
    public function json(bool $returnsRequest = false): ResponseInterface|array
    {
        $url = sprintf(self::JSON_API_URL, $this->cep->onlyNumbers());

        $response = (new Client())->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        if ($returnsRequest) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
            return [
                'erro' => true,
                'status' => $response->getStatusCode(),
                'message' => 'CEP not found or invalid.',
                'cep' => $this->cep->onlyNumbers(),
            ];
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Fetches the address data from the ViaCEP API in XML format.
     *
     * @param bool $returnsRequest
     * @return string|ResponseInterface The XML response.
     * @throws GuzzleException
     */
    public function xml(bool $returnsRequest = false): string|ResponseInterface
    {
        $url = sprintf(self::XML_API_URL, $this->cep->onlyNumbers());

        $response = (new Client())->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/xml',
            ],
        ]);

        if ($returnsRequest) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
            return '<erro>CEP not found or invalid.</erro>';
        }

        return $response->getBody()->getContents();
    }

    /**
     * Gets the complete address data from the ViaCEP API response.
     *
     * @return string
     * @throws GuzzleException
     */
    public function completeJson(): string
    {
        $response = $this->json(true);
        return (new CompleteResponse($response))->toJson();
    }

    /**
     *
     * Gets the complete address data from the ViaCEP API response as an object.
     *
     * @throws GuzzleException
     */
    public function completeResponseObject(): Response
    {
        return (new CompleteResponse(
            $this->json(true)
        ))->dataAsObject();
    }
}
