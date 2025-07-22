<?php

namespace Entities;

use PHPUnit\Framework\Attributes\Test;
use Yzpeedro\ViacepHardcore\Entities\Gia;
use Yzpeedro\ViacepHardcore\Tests\TestCase;

class GIATest extends TestCase
{
    #[Test]
    public function it_should_return_a_fake_instance_of_gia(): void
    {
        $gia = Gia::fake();
        $this->assertIsString($gia);
    }

    #[Test]
    public function it_should_return_a_valid_value_when_using_get_method(): void
    {
        $gia = new Gia('GIA192851240');
        $this->assertEquals('GIA192851240', $gia->get());
    }

    #[Test]
    public function it_should_set_value_when_using_set_method(): void
    {
        $gia = new Gia();
        $gia->set('GIA192851240');

        $this->assertEquals('GIA192851240', $gia->get());
    }

    #[Test]
    public function it_should_return_false_when_gia_is_not_valid(): void
    {
        $gia = new Gia('');
        $this->assertFalse($gia->isValid());
    }

    #[Test]
    public function it_should_return_true_when_gia_is_not_valid(): void
    {
        $gia = new Gia('GIA192851240');
        $this->assertTrue($gia->isValid());
    }
}
