<?php

namespace ValueObjects\Numerical;
use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\Numerical\Float;

/**
 * Class FloatTest
 */
final class FloatTest extends \PHPUnit_Framework_TestCase
{

    public function testInitiationWithANonFloatResultsInADomainExceptionBeingThrown()
    {
        $nonValidValues = array(
            'test',
            new \StdClass(),
            array(),
        );

        foreach ($nonValidValues as $nonValidValue) {
            try {
                new Float($nonValidValue);

                $this->fail('a new float was created with value: ' . var_export($nonValidValue, true));
            } catch (DomainException $exception) {
                $this->assertTrue(true);
            }
        }
    }

    public function testIsEqualToReturnsTrueIfTwoFloatsHaveTheSameValue()
    {
        $sameValue = 3.2;

        $float1 = new Float($sameValue);
        $float2 = new Float($sameValue);

        $this->assertTrue($float1->isEqualTo($float2));
        $this->assertTrue($float2->isEqualTo($float1));
    }

    public function testIsEqualToReturnsFalseIfTwoDifferentFloatsAreCompared()
    {
        $float1 = new Float(1.3);
        $float2 = new Float(4.5);

        $this->assertFalse($float1->isEqualTo($float2));
        $this->assertFalse($float2->isEqualTo($float1));
    }

    public function testIsBiggerThanReturnsTrueIfTheTestedFloatIsBiggerThanTheOneComparedAgainst()
    {
        $tested = new Float(1.0);
        $compared = new Float(0.2);

        $this->assertTrue($tested->isBiggerThan($compared));
    }

    public function testIsBiggerThanReturnsFalseIfTheTestedFloatIsNotBiggerThanTheOneComparedAgainst()
    {
        $tested = new Float(1.0);
        $equal = clone $tested;
        $bigger = new Float(2.2);

        $this->assertFalse($tested->isBiggerThan($equal));
        $this->assertFalse($tested->isBiggerThan($bigger));
    }

    public function testIsLessThanReturnsTrueIfTheTestedFloatIsSmallerThanTheOneComparedAgainst()
    {
        $tested = new Float(1.0);
        $less = new Float(2.9);

        $this->assertTrue($tested->isLessThan($less));
    }

    public function testIsLessThanReturnsFalseIfTheTestedFloatIsnotSmallerThanTheOneComparedAgainst()
    {
        $tested = new Float(0.3);
        $testedAgainst = new Float(0.2);
        $equal = clone $tested;

        $this->assertFalse($tested->isLessThan($testedAgainst));
        $this->assertFalse($tested->isLessThan($equal));
    }

    public function testGetValueReturnsTheSameValueYouPutIn()
    {
        $inputValue = 0.5;

        $float = new Float($inputValue);

        $this->assertTrue(number_format($float->getValue(), 1) === number_format($inputValue, 1));
    }

    public function testAsStringReturnsTheStringRepresentationOfTheFloatWePutIn()
    {
        $input = 0.5;
        $expectedInputAsString = '0.50';

        $float = new Float($input);

        $this->assertTrue($float->asString(2) === $expectedInputAsString);
        $this->assertTrue((string)$float === $expectedInputAsString);
    }
}
