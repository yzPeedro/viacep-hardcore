<?php

namespace Entities;

use PHPUnit\Framework\Attributes\Test;
use Yzpeedro\ViacepHardcore\Entities\Logradouro;
use Yzpeedro\ViacepHardcore\Tests\TestCase;

class LogradouroTest extends TestCase
{
    #[Test]
    public function it_should_return_a_fake_instance_of_logradouro(): void
    {
        $logradouro = Logradouro::fake();
        $this->assertIsString($logradouro);
    }

    #[Test]
    public function it_should_return_a_valid_value_when_using_get_method(): void
    {
        $logradouro = new Logradouro('Avenida Amazonas');
        $this->assertEquals('Avenida Amazonas', $logradouro->get());
    }

    #[Test]
    public function it_should_set_value_when_using_set_method(): void
    {
        $logradouro = new Logradouro();
        $logradouro->set('Avenida Amazonas');

        $this->assertEquals('Avenida Amazonas', $logradouro->get());
    }

    #[Test]
    public function it_should_return_false_when_logradouro_is_not_valid(): void
    {
        $logradouro = new Logradouro('');
        $this->assertFalse($logradouro->isValid());
    }

    #[Test]
    public function it_should_return_true_when_logradouro_is_not_valid(): void
    {
        $logradouro = new Logradouro('Avenida Amazonas');
        $this->assertTrue($logradouro->isValid());
    }
}
