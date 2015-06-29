<?php

namespace ValueObjects\Identity;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\Identity\UUID;
use Gnoesiboe\ValueObjects\String\String;

/**
 * Class UUIDTest
 */
final class UUIDTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructionFailsWhenProvidingAnInvalidValue()
    {
        $invalidValue = 'test';

        try {
            new UUID(new String($invalidValue));

            $this->fail('Did not throw an exception');
        } catch (DomainException $exception) {
            $this->assertTrue(true);
        }
    }

    public function testGenerateMethodCreatesANewUUID()
    {
        $uuid = UUID::generate();

        $this->assertTrue($uuid instanceof UUID);

        try {
            $uuid2 = new UUID($uuid->getValue());

            $this->assertTrue(true);
        } catch (DomainException $exception) {
            $this->fail('Throws a domain exception');
        }
    }

    public function testGetValueReturnsTheSameValueYouPutIn()
    {
        $validValue = 'd3f37510-5d42-4766-aa6f-2e5883e7e885';

        $uuid = new UUID(new String($validValue));

        $this->assertTrue($uuid->getValue()->isEqualTo(new String($validValue)));
        $this->assertTrue($uuid->getValue()->getValue() === $validValue);
    }
}
