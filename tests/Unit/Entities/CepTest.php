<?php

namespace Entities;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Yzpeedro\ViacepHardcore\Entities\CEP;
use Yzpeedro\ViacepHardcore\Tests\TestCase;

class CepTest extends TestCase
{
    #[Test]
    public function it_should_generate_a_fake_cep(): void
    {
        $cep = CEP::fake();
        $this->assertIsString($cep);
        $this->assertMatchesRegularExpression('/^\d{5}-\d{3}$/', $cep);
    }

    #[Test]
    public function it_should_return_value_using_get_method(): void
    {
        $cep = new CEP('12345-678');
        $this->assertEquals('12345-678', $cep->get());
    }

    #[Test]
    public function it_should_return_value_with_mask_when_using_as_string(): void
    {
        $cep = new CEP('12345678');
        $this->assertEquals('12345-678', (string) $cep);
    }

    #[Test]
    public function it_should_return_value_without_mask_when_using_only_numbers_method(): void
    {
        $cep = new CEP('12345-678');
        $this->assertEquals('12345678', $cep->onlyNumbers());
    }

    #[Test]
    public function it_should_return_value_with_mask_when_using_with_mask_method(): void
    {
        $cep = new CEP('12345678');
        $this->assertEquals('12345-678', $cep->withMask());
    }

    #[Test]
    public function it_should_return_true_when_cep_is_valid(): void
    {
        $cep = new CEP('12345-678');
        $this->assertTrue($cep->isValid());
    }

    #[Test]
    public function it_should_return_false_when_cep_is_invalid(): void
    {
        $cep = new CEP('invalid-cep');
        $this->assertFalse($cep->isValid());
    }

    #[Test]
    public function it_should_validate_cep_before_set(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $cep = new CEP();
        $cep->set('invalid-cep');

        $this->assertFalse($cep->isValid());
    }
}
