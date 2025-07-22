<?php

namespace Yzpeedro\ViacepHardcore\Responses;

use Override;
use Psr\Http\Message\ResponseInterface;
use Yzpeedro\ViacepHardcore\Contracts\Jsonable;
use Yzpeedro\ViacepHardcore\Entities\Bairro;
use Yzpeedro\ViacepHardcore\Entities\CEP;
use Yzpeedro\ViacepHardcore\Entities\Complemento;
use Yzpeedro\ViacepHardcore\Entities\Gia;
use Yzpeedro\ViacepHardcore\Entities\IBGE;
use Yzpeedro\ViacepHardcore\Entities\Localidade;
use Yzpeedro\ViacepHardcore\Entities\Logradouro;
use Yzpeedro\ViacepHardcore\Entities\UF;
use Yzpeedro\ViacepHardcore\Responses\Data\Data;
use Yzpeedro\ViacepHardcore\Responses\Data\RawData;
use Yzpeedro\ViacepHardcore\Responses\Data\Response;

class CompleteResponse implements Jsonable
{
    /**
     * Returns the response status code.
     *
     * @return int
     */
    private function getStatus(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * Returns the response content.
     *
     * @return array
     */
    private function getContent(): array
    {
        $content = json_decode($this->response->getBody()->getContents(), true);
        return is_array($content) ? $content : [];
    }

    public function __construct(
        private ResponseInterface $response
    ) {
    }

    /**
     * Gets the complete address data from the ViaCEP API response.
     *
     * @return array{
     *     error: bool,
     *     status: int,
     *     data: array{cep: CEP, logradouro: Logradouro, complemento: Complemento, bairro: Bairro, localidade: Localidade, uf: UF, ibge: IBGE, gia: Gia},
     *     raw_data: array<string, mixed>
     *     }
     */
    public function data(): array
    {
        $status = $this->getStatus();
        $rawData = $this->getRawDataObject();

        if ($status < 200 || $status >= 300) {
            return [
                'error' => true,
                'status' => $status,
                'data' => [],
                'raw_data' => $rawData,
            ];
        }

        return [
            'error' => false,
            'status' => $status,
            'data' => [
                'cep' => CEP::makeWith($rawData->cep),
                'logradouro' => Logradouro::makeWith($rawData->logradouro),
                'complemento' => Complemento::makeWith($rawData->complemento ?? ''),
                'bairro' => Bairro::makeWith($rawData->bairro ?? ''),
                'localidade' => Localidade::makeWith($rawData->localidade ?? ''),
                'uf' => UF::makeWith($rawData->uf ?? ''),
                'ibge' => IBGE::makeWith($rawData->ibge ?? ''),
                'gia' => Gia::makeWith($rawData->gia ?? ''),
            ],
            'raw_data' => $rawData,
        ];
    }

    /**
     * Gets the complete address data as a Response object.
     *
     * @return Response
     */
    public function dataAsObject(): Response
    {
        $data = $this->data();

        return new Response(
            error: $data['error'],
            status: $data['status'],
            data: Data::makeWithArray($data['data']),
            rawData: $data['raw_data']
        );
    }

    /**
     * Gets the raw data from the response as a RawData object.
     *
     * @return RawData
     */
    public function getRawDataObject(): RawData
    {
        $rawData = $this->getContent();
        return new RawData(...$rawData);
    }

    /**
     * Converts the complete address data to JSON format.
     *
     * @return string
     */
    #[Override]
    public function toJson(): string
    {
        return json_encode($this->data());
    }

    /**
     * Get the response error.
     *
     * @return bool
     */
    public function error(): bool
    {
        return $this->data()['error'];
    }

    /**
     * Get the response status code.
     *
     * @return int
     */
    public function status(): int
    {
        return $this->data()['status'];
    }

    /**
     * Gets the complete address data as a Data object.
     *
     * @return Data
     */
    public function getDataObject(): Data
    {
        $data = $this->data()['data'];
        return new Data(...$data);
    }
}
