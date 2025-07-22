<?php

namespace Entities;

use PHPUnit\Framework\Attributes\Test;
use Yzpeedro\ViacepHardcore\Entities\Localidade;
use Yzpeedro\ViacepHardcore\Tests\TestCase;

class LocalidadeTest extends TestCase
{
    #[Test]
    public function it_should_return_a_fake_instance_of_localidade(): void
    {
        $localidade = Localidade::fake();
        $this->assertIsString($localidade);
    }

    #[Test]
    public function it_should_return_a_valid_value_when_using_get_method(): void
    {
        $localidade = new Localidade('Belo Horizonte');
        $this->assertEquals('Belo Horizonte', $localidade->get());
    }

    #[Test]
    public function it_should_set_value_when_using_set_method(): void
    {
        $localidade = new Localidade();
        $localidade->set('Belo Horizonte');

        $this->assertEquals('Belo Horizonte', $localidade->get());
    }

    #[Test]
    public function it_should_return_false_when_localidade_is_not_valid(): void
    {
        $localidade = new Localidade('');
        $this->assertFalse($localidade->isValid());
    }

    #[Test]
    public function it_should_return_true_when_localidade_is_not_valid(): void
    {
        $localidade = new Localidade('Belo Horizonte');
        $this->assertTrue($localidade->isValid());
    }
}
