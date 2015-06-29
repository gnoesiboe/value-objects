<?php

namespace Gnoesiboe\ValueObjects\Format;

use Gnoesiboe\ValueObjects\Contract\ValueObjectInterface;
use Gnoesiboe\ValueObjects\Exception\DomainException;
use Gnoesiboe\ValueObjects\SingleValueObject;
use Gnoesiboe\ValueObjects\String\String;

/**
 * Class JSON
 */
final class JSON extends SingleValueObject implements ValueObjectInterface
{

    /**
     * @var \Gnoesiboe\ValueObjects\String\String
     */
    private $value;

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $value
     */
    public function __construct(String $value)
    {
        $this->setValue($value);
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $value
     */
    private function setValue(String $value)
    {
        $this->validateValue($value);

        $this->value = $value;
    }

    /**
     * @param \Gnoesiboe\ValueObjects\String\String $value
     *
     * @throws DomainException
     */
    private function validateValue(String $value)
    {
        $this->clearJsonLastError();

        json_decode($value);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $errorMessage = $this->extractJsonLastError();

            $this->clearJsonLastError();

            throw $this->createDomainException($errorMessage);
        }
    }

    /**
     * @return string
     */
    private function extractJsonLastError()
    {
        if (function_exists('json_last_error_msg')) {
            return json_last_error_msg();
        } else {
            return $this->extractMessageFromJsonLastError();
        }
    }

    private function clearJsonLastError()
    {
        json_encode(null);
    }

    /**
     * @return string
     */
    private function extractMessageFromJsonLastError()
    {
        switch (json_last_error()) {
            case JSON_ERROR_DEPTH:
                return 'Maximum stack depth exceeded.';

            case JSON_ERROR_STATE_MISMATCH:
                return 'Underflow or the modes mismatch.';

            case JSON_ERROR_CTRL_CHAR:
                return 'Unexpected control character found.';

            case JSON_ERROR_SYNTAX:
                return 'Syntax error, malformed JSON.';

            case JSON_ERROR_UTF8:
                return 'Malformed UTF-8 characters, possibly incorrectly encoded.';

            default:
                return 'Unknown error.';
        }
    }

    /**
     * @param JSON $json
     *
     * @return bool
     */
    public function isEqualTo(JSON $json)
    {
        return $this->getValue()->isEqualTo($json->getValue());
    }

    /**
     * @return \Gnoesiboe\ValueObjects\String\String
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     *
     * @return mixed
     */
    public function decode($assoc = false, $depth = 512, $options = 0)
    {
        return json_decode($this->value->getValue(), $assoc, $depth, $options);
    }
}
