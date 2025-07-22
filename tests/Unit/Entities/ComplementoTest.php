<?php

namespace Entities;

use PHPUnit\Framework\Attributes\Test;
use Yzpeedro\ViacepHardcore\Entities\Complemento;
use Yzpeedro\ViacepHardcore\Tests\TestCase;

class ComplementoTest extends TestCase
{
    #[Test]
    public function it_should_return_all_complements(): void
    {
        $this->assertIsArray(Complemento::COMPLEMENTS);
    }

    #[Test]
    public function it_should_return_a_fake_instance_of_complemento(): void
    {
        $complemento = Complemento::fake();
        $this->assertIsString($complemento);
    }

    #[Test]
    public function it_should_return_a_valid_value_when_using_get_method(): void
    {
        $complemento = new Complemento('Apto. 123');
        $this->assertEquals('Apto. 123', $complemento->get());
    }

    #[Test]
    public function it_should_set_value_when_using_set_method(): void
    {
        $complemento = new Complemento();
        $complemento->set('Casa 456');

        $this->assertEquals('Casa 456', $complemento->get());
    }

    #[Test]
    public function it_should_return_false_when_complement_is_not_valid(): void
    {
        $complemento = new Complemento('');
        $this->assertFalse($complemento->isValid());
    }

    #[Test]
    public function it_should_return_true_when_complement_is_not_valid(): void
    {
        $complemento = new Complemento('Casa 456');
        $this->assertTrue($complemento->isValid());
    }
}
