<?php

namespace Yzpeedro\ViacepHardcore\Helpers;

use Faker\Factory;
use Faker\Generator;

trait Faker
{
    /**
     * A method to create a Faker instance.
     *
     * @return Generator
     */
    public function getInstance(): Generator
    {
        $faker = Factory::create('pt_BR');
        $faker->setDefaultTimezone('America/Sao_Paulo');

        return $faker;
    }
}
