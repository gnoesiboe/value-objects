<?php


namespace ValueObjects\Other;

use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\Other\YesNoMaybe;
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
}
