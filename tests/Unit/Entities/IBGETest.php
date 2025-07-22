<?php

namespace Entities;

use PHPUnit\Framework\Attributes\Test;
use Yzpeedro\ViacepHardcore\Entities\IBGE;
use Yzpeedro\ViacepHardcore\Tests\TestCase;

class IBGETest extends TestCase
{
    #[Test]
    public function it_should_return_a_fake_instance_of_ibge(): void
    {
        $ibge = IBGE::fake();
        $this->assertIsString($ibge);
    }

    #[Test]
    public function it_should_return_a_valid_value_when_using_get_method(): void
    {
        $ibge = new IBGE('19382174');
        $this->assertEquals('19382174', $ibge->get());
    }

    #[Test]
    public function it_should_set_value_when_using_set_method(): void
    {
        $ibge = new IBGE();
        $ibge->set('19382174');

        $this->assertEquals('19382174', $ibge->get());
    }

    #[Test]
    public function it_should_return_false_when_ibge_is_not_valid(): void
    {
        $ibge = new IBGE('');
        $this->assertFalse($ibge->isValid());
    }

    #[Test]
    public function it_should_return_true_when_ibge_is_not_valid(): void
    {
        $ibge = new IBGE('19382174');
        $this->assertTrue($ibge->isValid());
    }
}
