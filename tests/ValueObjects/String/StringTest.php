<?php

namespace Gnoesiboe\ValueObjects\String;

use Gnoesiboe\ValueObjects\Exception\DomainException;

/**
 * Class StringTest
 */
final class StringTest extends \PHPUnit_Framework_TestCase
{

    public function testThrowsDomainExceptionOnNonStringValues()
    {
        $nonStringValues = array(
            123,
            392.392,
            new \StdClass(),
            array('eerste', 3)
        );

        foreach ($nonStringValues as $nonStringValue) {
            try {
                new String($nonStringValue);

                $this->fail('Value should have thrown a DomainException');
            } catch (DomainException $exception) {
                $this->assertTrue(true);
            }
        }
    }

    public function testInstantiationSucceedsWhenProvidingAStringValue()
    {
        $someStringValue = 'test';

        try {
            $string = new String($someStringValue);

            $this->assertTrue($string instanceof String);
        } catch (DomainException $exception) {
            $this->fail('No DomainException should be thrown');
        }
    }

    public function testGetLengthReturnsTheLengthOfTheStringYouPutIntoIt()
    {
        $inputString = 'some input string';

        $string = new String($inputString);

        $this->assertTrue(strlen($inputString) === $string->getLength());
    }

    public function testTwoStringsWithTheSameLengthAreAsLongAsEachOther()
    {
        $string1 = new String('string1');
        $string2 = new String('string2');

        $this->assertTrue($string1->isAsLongAs($string2));
    }

    public function testTwoStringsWithDifferentLengthsAreNotAsLongAsEachOther()
    {
        $string1 = new String('water');
        $string2 = new String('anders nog wat maar dan langer');

        $this->assertFalse($string1->isAsLongAs($string2));
    }

    public function testIsLongerThanOrAsLongAsWorksWithTwoEquallyLengthedStrings()
    {
        $string1 = new String('string1');
        $string2 = new String('string2');

        $this->assertTrue($string1->isLongerThanOrAsLongAs($string2));
    }

    public function testIsLongerThanOrEqualToReturnsTrueWhenTheTestedStringIsLongerThanTheProvidedString()
    {
        $string1 = new String('A very long string that has lots of characters');
        $string2 = new String('short');

        $this->assertTrue($string1->isLongerThanOrAsLongAs($string2));
    }

    public function testIsLongerThanOrEqualToReturnsFalseWhenTheTestedStringIsShorterThanTheProvidedString()
    {
        $string1 = new String('short');
        $string2 = new String('A very long string that has lots of characters');

        $this->assertFalse($string1->isLongerThanOrAsLongAs($string2));
    }

    public function testIsLongerThanReturnsTrueIfTheTestedStringIsLongerThanTheProvidedString()
    {
        $string1 = new String('A very long string that has lots of characters');
        $string2 = new String('short');

        $this->assertTrue($string1->isLongerThan($string2));
    }

    public function testIsLongerReturnsFalseIfTheTestedStringIsShorterThanTheProvidedString()
    {
        $string1 = new String('short');
        $string2 = new String('A very long string that has lots of characters');

        $this->assertFalse($string1->isLongerThan($string2));
    }

    public function testIsShorterThanReturnsTrueIfTheTestedStringIsShorterThanTheProvidedString()
    {
        $string1 = new String('short');
        $string2 = new String('A very long string that has lots of characters');

        $this->assertTrue($string1->isShorterThan($string2));
    }

    public function testIsShorterThanReturnsFalseIfTheTestedStringIsLongerThanTheProvidedString()
    {
        $string1 = new String('A very long string that has lots of characters');
        $string2 = new String('short');

        $this->assertFalse($string1->isShorterThan($string2));
    }

    public function testIsShorterThanOrAsLongAsReturnsTrueIfBothSidesAreEquallyTheLength()
    {
        $string1 = new String('string1');
        $string2 = new String('string2');

        $this->assertTrue($string1->isShorterThanOrAsLongAs($string2));
    }

    public function testIsShorterThanOrAsLongAsReturnTrueIfTheTestedStringIsShorterThanTheProvidedString()
    {
        $string1 = new String('short');
        $string2 = new String('A very long string that has lots of characters');

        $this->assertTrue($string1->isShorterThanOrAsLongAs($string2));
    }

    public function testIsShorterThanOrAsLongAsReturnFalseIfTheTestedStringIsLongerThanTheProvidedString()
    {
        $string1 = new String('A very long string that has lots of characters');
        $string2 = new String('short');

        $this->assertFalse($string1->isShorterThanOrAsLongAs($string2));
    }

    public function testIsEqualToReturnsTrueIfBothSidesHaveTheSameValue()
    {
        $value = 'the same value';

        $string1 = new String($value);
        $string2 = new String($value);

        $this->assertTrue($string1->isEqualTo($string2));
    }

    public function testIsEqualToReturnsFalseIfBothSidesHaveADifferentValue()
    {
        $string1 = new String('string1');
        $string2 = new String('string2');

        $this->assertFalse($string1->isEqualTo($string2));
    }

    public function testGetValueReturnsTheSameValueYouPutIntoIt()
    {
        $value = 'some value';

        $string = new String($value);

        $this->assertTrue($value === $string->getValue());
    }

    public function testToStringReturnsTheSameStringYouPutIntoIt()
    {
        $value = 'some value';

        $string = new String($value);

        $this->assertTrue($value === $string->__toString());
    }
}
