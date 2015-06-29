<?php

namespace ValueObjects\Numerical;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\Numerical\Integer;

/**
 * Class Integer
 */
final class IntegerTest extends \PHPUnit_Framework_TestCase
{

    public function testInstantiationWithANonIntegerValueResultsInADomainExceptionThrown()
    {
        $nonIntegerValues = array(
            array(),
            'test',
            '32323.323',
            3293.393,
            new \StdClass()
        );

        foreach ($nonIntegerValues as $nonIntegerValue) {
            try {
                new Integer($nonIntegerValue);

                $this->fail('a new integer was created with value: ' . var_export($nonIntegerValue, true));
            } catch (DomainException $exception) {
                $this->assertTrue(true);
            }
        }
    }

    public function testInstantiationWithAValidIntegerDoesNotResultInADomainException()
    {
        $validValues = array(
            '1234',
            '-2923',
            2923,
            -392323,
            0
        );

        foreach ($validValues as $validValue) {
            $integer = new Integer($validValue);

            $this->assertTrue($integer instanceof Integer);
        }
    }

    public function testIsEqualToReturnsTrueIfTwoIntegersHaveTheSameValue()
    {
        $sameValue = 3;

        $integer1 = new Integer($sameValue);
        $integer2 = new Integer($sameValue);

        $this->assertTrue($integer1->isEqualTo($integer2));
        $this->assertTrue($integer2->isEqualTo($integer1));
    }

    public function testIsEqualReturnsFalseIfTwoDifferentIntegersAreCompared()
    {
        $integer1 = new Integer(1);
        $integer2 = new Integer(2);

        $this->assertFalse($integer1->isEqualTo($integer2));
        $this->assertFalse($integer2->isEqualTo($integer1));
    }

    public function testIsBiggerThanReturnsTrueIfTheTestedIntegerIsBiggerThanTheCompared()
    {
        $tested = new Integer(3);
        $compared = new Integer(-2);

        $this->assertTrue($tested->isBiggerThan($compared));
    }

    public function testIsBiggerThanReturnsFalseIfTheTestedIntegerIsNotBiggerThanTheCompared()
    {
        $tested = new Integer(0);
        $compared = new Integer(3);
        $same = clone $tested;

        $this->assertFalse($tested->isBiggerThan($compared));
        $this->assertFalse($tested->isBiggerThan($same));
    }

    public function testIsLessThanReturnsTrueIfTheTestedIntegerIsSmallerThanTheCompared()
    {
        $tested = new Integer(0);
        $compared = new Integer(3);

        $this->assertTrue($tested->isLessThan($compared));
    }

    public function testIsLessThanReturnsFalseIfTheTestedIntegerIsNotSmallerThanTheCompared()
    {
        $tested = new Integer(3);
        $compared = new Integer(0);
        $same = clone $tested;

        $this->assertFalse($tested->isLessThan($compared));
        $this->assertFalse($tested->isLessThan($same));
    }

    public function testGetValueReturnsTheValueYouPutIn()
    {
        $sameValue = 3;

        $integer = new Integer($sameValue);

        $this->assertTrue((int)$integer->getValue() === (int)$sameValue);
    }
}
