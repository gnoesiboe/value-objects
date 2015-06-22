<?php

namespace Tests\Gnoesiboe\ValueObjects\Web;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\String\String;
use Gnoesiboe\ValueObjects\Web\EmailAddress;

/**
 * Class EmailAddressTest
 */
final class EmailAddressTest extends \PHPUnit_Framework_TestCase
{

    public function testThrowsDomainExceptionIfNotAValidEmailAddress()
    {
        $nonValidEmailAddress = 'test';

        try {
            new EmailAddress(new String($nonValidEmailAddress));

            $this->fail('wrong email address did not throw a DomainException');
        } catch (DomainException $exception) {
            $this->assertTrue(true);
        }
    }

    public function testSucceedsWhenProvidedWithAValidEmailAddress()
    {
        $validEmailAddress = 'gijsnieuwenhuis@gmail.com';

        try {
            $emailAddress = new EmailAddress(new String($validEmailAddress));

            $this->assertTrue($emailAddress instanceof EmailAddress);
        } catch (DomainException $exception) {
            $this->fail('valid email address did result in a DomainException');
        }
    }

    public function testIsEqualToReturnsTrueIfBothEmailsHaveTheSameValue()
    {
        $sameValue = 'gijsnieuwenhuis@gmail.com';

        $email1 = new EmailAddress(new String($sameValue));
        $email2 = new EmailAddress(new String($sameValue));

        $this->assertTrue($email1->isEqualTo($email2));
    }

    public function testToStringReturnsTheExactValueYouPutIntoIt()
    {
        $sameValue = 'gijsnieuwenhuis@gmail.com';

        $email = new EmailAddress(new String($sameValue));

        $this->assertTrue($email->__toString() === $sameValue);
    }

    public function testGetValueReturnsAStringObjectContaingTheStringYouPutIntoIt()
    {
        $sameValue = 'gijsnieuwenhuis@gmail.com';

        $email = new EmailAddress(new String($sameValue));

        $string = $email->getValue();

        $this->assertTrue($string instanceof String);
        $this->assertTrue($string->getValue() === $sameValue);
    }
}
