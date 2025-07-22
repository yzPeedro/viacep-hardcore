<?php

namespace Entities;

use PHPUnit\Framework\Attributes\Test;
use Yzpeedro\ViacepHardcore\Entities\Siafi;
use Yzpeedro\ViacepHardcore\Tests\TestCase;

class SiafiTest extends TestCase
{
    #[Test]
    public function it_should_return_a_fake_instance_of_siafi(): void
    {
        $siafi = Siafi::fake();
        $this->assertIsString($siafi);
    }

    #[Test]
    public function it_should_return_a_valid_value_when_using_get_method(): void
    {
        $siafi = new Siafi('9285');
        $this->assertEquals('9285', $siafi->get());
    }

    #[Test]
    public function it_should_set_value_when_using_set_method(): void
    {
        $siafi = new Siafi();
        $siafi->set('9285');

        $this->assertEquals('9285', $siafi->get());
    }

    #[Test]
    public function it_should_return_false_when_siafi_is_not_valid(): void
    {
        $siafi = new Siafi('');
        $this->assertFalse($siafi->isValid());
    }

    #[Test]
    public function it_should_return_true_when_siafi_is_not_valid(): void
    {
        $siafi = new Siafi('9285');
        $this->assertTrue($siafi->isValid());
    }
}
