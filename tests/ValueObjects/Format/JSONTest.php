<?php

namespace ValueObjects\Format;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\Format\JSON;
use Gnoesiboe\ValueObjects\String\String;

/**
 * Class JSONTest
 */
final class JSONTest extends \PHPUnit_Framework_TestCase
{

    public function testThrowsDomainExceptionWhenProvidingInvalidValues()
    {
        $invalidValues = array(
            new String('basdlksdf'),
            new String("{ \"test':3 }"),
        );

        foreach ($invalidValues as $invalidValue) {
            /** @var \Gnoesiboe\ValueObjects\String\String $invalidValue */

            try {
                new JSON($invalidValue);

                $this->fail('Should not throw an exception for value: ' . var_export($invalidValue, true));
            } catch (DomainException $exception) {
                $this->assertTrue(true);
            }
        }
    }

    public function testDoesNotThrowDomainExceptionWithValidJSONValues()
    {
        $validValues = array(
            new String('{ "waarde": 3 }'),
            new String(''),
            new String('{"eerste":{"water":3,"anders":"vierde"},"tweede":"vierde"}'),
        );

        foreach ($validValues as $validValue) {
            /** @var \Gnoesiboe\ValueObjects\String\String $validValue */

            try {
                new JSON($validValue);

                $this->assertTrue(true);
            } catch (DomainException $exception) {
                $this->fail($exception->getMessage());
            }
        }
    }

    public function testGetValueReturnsTheSameValueYouPutIntoIt()
    {
        $sameValue = new String('{"eerste":{"water":3,"anders":"vierde"},"tweede":"vierde"}');

        $json = new JSON($sameValue);

        $this->assertTrue($json->getValue()->isEqualTo($sameValue));
    }

    public function testDecodeReturnsTheSameValueThatIsPutIn()
    {
        $input = array(
            'eersete' => 3,
            'waarde' => array(
                'anders' => 3,
                'nogwat' => 2393
            )
        );

        $json = new JSON(new String(json_encode($input)));

        $this->assertTrue($json->decode(true) === $input);
    }

    public function testIsEqualToReturnsTrueIfTwoValuesAreTheSame()
    {
        $firstJSON = new JSON(new String('{ "water": 3 }'));
        $secondJSON = new JSON(new String('{ "water": 3 }'));

        $this->assertTrue($firstJSON->isEqualTo($secondJSON));
    }

    public function testIsEqualToReturnsFalseIfTwoValuesDoNotMatch()
    {
        $firstJSON = new JSON(new String('{ "water": 3 }'));
        $secondJSON = new JSON(new String('{ "anders": "nogwat" }'));

        $this->assertFalse($firstJSON->isEqualTo($secondJSON));
    }
}
