<?php

namespace Entities;

use PHPUnit\Framework\Attributes\Test;
use Yzpeedro\ViacepHardcore\Entities\Regiao;
use Yzpeedro\ViacepHardcore\Tests\TestCase;

class RegiaoTest extends TestCase
{
    #[Test]
    public function it_should_return_a_fake_instance_of_region(): void
    {
        $region = Regiao::fake();
        $this->assertIsString($region);
    }

    #[Test]
    public function it_should_return_a_valid_value_when_using_get_method(): void
    {
        $region = new Regiao('Sudeste');
        $this->assertEquals('Sudeste', $region->get());
    }

    #[Test]
    public function it_should_set_value_when_using_set_method(): void
    {
        $region = new Regiao();
        $region->set('Sudeste');

        $this->assertEquals('Sudeste', $region->get());
    }

    #[Test]
    public function it_should_return_false_when_region_is_not_valid(): void
    {
        $region = new Regiao('');
        $this->assertFalse($region->isValid());
    }

    #[Test]
    public function it_should_return_true_when_region_is_not_valid(): void
    {
        $region = new Regiao('Sudeste');
        $this->assertTrue($region->isValid());
    }
}
