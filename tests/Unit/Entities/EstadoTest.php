<?php

namespace Entities;

use PHPUnit\Framework\Attributes\Test;
use Yzpeedro\ViacepHardcore\Entities\Estado;
use Yzpeedro\ViacepHardcore\Tests\TestCase;

class EstadoTest extends TestCase
{
    #[Test]
    public function it_should_return_a_fake_instance_of_state(): void
    {
        $state = Estado::fake();
        $this->assertIsString($state);
    }

    #[Test]
    public function it_should_return_a_valid_value_when_using_get_method(): void
    {
        $state = new Estado('Minas Gerais');
        $this->assertEquals('Minas Gerais', $state->get());
    }

    #[Test]
    public function it_should_set_value_when_using_set_method(): void
    {
        $state = new Estado();
        $state->set('Minas Gerais');

        $this->assertEquals('Minas Gerais', $state->get());
    }

    #[Test]
    public function it_should_return_false_when_state_is_not_valid(): void
    {
        $state = new Estado('');
        $this->assertFalse($state->isValid());
    }

    #[Test]
    public function it_should_return_true_when_state_is_not_valid(): void
    {
        $state = new Estado('Minas Gerais');
        $this->assertTrue($state->isValid());
    }
}
