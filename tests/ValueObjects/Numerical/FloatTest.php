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
}
