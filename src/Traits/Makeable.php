<?php

namespace Yzpeedro\ViacepHardcore\Traits;

use Yzpeedro\ViacepHardcore\Abstract\Entities\Entity;
use Yzpeedro\ViacepHardcore\Contracts\Fakecable;
use Yzpeedro\ViacepHardcore\Contracts\Gettable;
use Yzpeedro\ViacepHardcore\Contracts\Settable;
use Yzpeedro\ViacepHardcore\Entities\Bairro;
use Yzpeedro\ViacepHardcore\Entities\CEP;
use Yzpeedro\ViacepHardcore\Entities\Complemento;
use Yzpeedro\ViacepHardcore\Entities\DDD;
use Yzpeedro\ViacepHardcore\Entities\Estado;
use Yzpeedro\ViacepHardcore\Entities\Gia;
use Yzpeedro\ViacepHardcore\Entities\IBGE;
use Yzpeedro\ViacepHardcore\Entities\Localidade;
use Yzpeedro\ViacepHardcore\Entities\Logradouro;
use Yzpeedro\ViacepHardcore\Entities\Regiao;
use Yzpeedro\ViacepHardcore\Entities\Siafi;
use Yzpeedro\ViacepHardcore\Entities\UF;
use Yzpeedro\ViacepHardcore\Entities\Unidade;
use Yzpeedro\ViacepHardcore\Exceptions\ClassNotFakeableException;
use Yzpeedro\ViacepHardcore\Responses\Data\Data;
use Yzpeedro\ViacepHardcore\Responses\Data\RawData;
use Yzpeedro\ViacepHardcore\Viacep;

/**
 * @mixin Gettable
 * @mixin Fakecable
 * @mixin Settable
 */
trait Makeable
{
    /**
     * Create a new instance of the class.
     *
     * @return Data|Entity|Bairro|CEP|Complemento|DDD|Estado|Gia|IBGE|Localidade|Logradouro|Regiao|Siafi|UF|Unidade|RawData|Makeable|Viacep
     */
    public static function make(): self
    {
        return new self();
    }

    /**
     * Create a new instance of the class with the given parameters.
     *
     * @param mixed ...$params
     * @return Data|Entity|Bairro|CEP|Complemento|DDD|Estado|Gia|IBGE|Localidade|Logradouro|Regiao|Siafi|UF|Unidade|RawData|Makeable|Viacep
     */
    public static function makeWith(...$params): self
    {
        return new self(...$params);
    }

    /**
     * Create a new instance of the class with the given parameters.
     *
     * @param array $params
     * @return Data|Entity|Bairro|CEP|Complemento|DDD|Estado|Gia|IBGE|Localidade|Logradouro|Regiao|Siafi|UF|Unidade|RawData|Makeable|Viacep
     */
    public static function makeWithArray(array $params): self
    {
        return new self(...$params);
    }

    /**
     * Create a new instance of the class with the given parameters.
     *
     * @param array $params
     * @return Data|Entity|Bairro|CEP|Complemento|DDD|Estado|Gia|IBGE|Localidade|Logradouro|Regiao|Siafi|UF|Unidade|RawData|Makeable|Viacep
     */
    public static function makeWithAssociativeArray(array $params): self
    {
        return new self(...array_values($params));
    }

    /**
     * Create a new instance of the class with the given parameters.
     *
     * @param array $params
     * @return Data|Entity|Bairro|CEP|Complemento|DDD|Estado|Gia|IBGE|Localidade|Logradouro|Regiao|Siafi|UF|Unidade|RawData|Makeable|Viacep
     */
    public static function makeWithAssociativeArrayAndKeys(array $params): self
    {
        $instance = new self();
        foreach ($params as $key => $value) {
            if (property_exists($instance, $key)) {
                $instance->{$key} = $value;
            }
        }
        return $instance;
    }

    /**
     * Create a new instance of the class with the given parameters.
     *
     * @param array $params
     * @return Data|Entity|Bairro|CEP|Complemento|DDD|Estado|Gia|IBGE|Localidade|Logradouro|Regiao|Siafi|UF|Unidade|RawData|Makeable|Viacep
     */
    public static function makeWithAssociativeArrayAndKeysAndValues(array $params): self
    {
        $instance = new self();
        foreach ($params as $key => $value) {
            if (property_exists($instance, $key)) {
                $instance->{$key} = $value;
            }
        }
        return $instance;
    }

    /**
     * Create a new instance of the class with fake values.
     *
     * @return Data|Entity|Bairro|CEP|Complemento|DDD|Estado|Gia|IBGE|Localidade|Logradouro|Regiao|Siafi|UF|Unidade|RawData|Makeable|Viacep
     * @throws ClassNotFakeableException
     */
    public static function makeWithFakeValue(): self
    {
        $instance = new self();

        if (!method_exists($instance, 'fake')) {
            throw new ClassNotFakeableException("The class " . static::class . " is not fakeable. Please implement the fake method.");
        }

        $instance->set($instance->fake());
        return $instance;
    }
}
