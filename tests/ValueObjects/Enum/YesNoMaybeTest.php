<?php


namespace ValueObjects\Enum;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\Enum\YesNoMaybe;
use Gnoesiboe\ValueObjects\String\String;

/**
 * Class YesNoMaybeTest
 */
final class YesNoMaybeTest extends \PHPUnit_Framework_TestCase
{

    public function testInstantiatingWithANonSupportedValueTriggersADomainException()
    {
        $nonSupportedString = new String('non_supported_value');

        try {
            new YesNoMaybe($nonSupportedString);

            $this->fail();
        } catch (DomainException $exception) {
            $this->assertTrue(true);
        }
    }

    public function testInstantiatingWithASupportedValueSucceeds()
    {
        $supportedValues = YesNoMaybe::getSupported();

        foreach ($supportedValues as $supportedValue) {
            /** @var \Gnoesiboe\ValueObjects\String\String $supportedValue */

            try {
                $instance = new YesNoMaybe($supportedValue);

                $this->assertTrue($instance instanceof YesNoMaybe);
            } catch (DomainException $exception) {
                $this->fail('Value resulted in a domain exception: ' . var_export($supportedValue, true));
            }
        }
    }

    public function testIsEqualToReturnsTrueOfTwoInstancesHaveTheSameValue()
    {
        $first = new YesNoMaybe(new String(YesNoMaybe::YES));
        $second = new YesNoMaybe(new String(YesNoMaybe::YES));

        $this->assertTrue($first->isEqualTo($second));
        $this->assertTrue($second->isEqualTo($first));
    }
}
