<?php

namespace Entities;

use PHPUnit\Framework\Attributes\Test;
use Yzpeedro\ViacepHardcore\Entities\DDD;
use Yzpeedro\ViacepHardcore\Tests\TestCase;

class DDDTest extends TestCase
{
    #[Test]
    public function it_should_return_a_fake_instance_of_ddd(): void
    {
        $ddd = DDD::fake();
        $this->assertIsString($ddd);
    }

    #[Test]
    public function it_should_return_a_valid_value_when_using_get_method(): void
    {
        $ddd = new DDD('31');
        $this->assertEquals('31', $ddd->get());
    }

    #[Test]
    public function it_should_set_value_when_using_set_method(): void
    {
        $ddd = new DDD();
        $ddd->set('11');

        $this->assertEquals('11', $ddd->get());
    }

    #[Test]
    public function it_should_return_false_when_ddd_is_not_valid(): void
    {
        $ddd = new DDD('');
        $this->assertFalse($ddd->isValid());
    }

    #[Test]
    public function it_should_return_true_when_ddd_is_not_valid(): void
    {
        $ddd = new DDD('11');
        $this->assertTrue($ddd->isValid());
    }
}
