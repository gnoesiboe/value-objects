<?php

namespace Gnoesiboe\ValueObjects\Time;

use Gnoesiboe\ValueObjects\ValueObject;
use Gnoesiboe\ValueObjects\ValueObjectInterface;

/**
 * Class Time
 */
class Time extends ValueObject implements ValueObjectInterface
{

    /**
     * @var Hours
     */
    private $hours;

    /**
     * @var Minutes
     */
    private $minutes;

    /**
     * @var Seconds
     */
    private $seconds;

    /**
     * @param Hours $hours
     * @param Minutes $minutes
     * @param Seconds $seconds
     */
    public function __construct(Hours $hours, Minutes $minutes, Seconds $seconds)
    {
        $this->hours = $hours;
        $this->minutes = $minutes;
        $this->seconds = $seconds;
    }

    /**
     * @param Time $time
     *
     * @return bool
     */
    public function isEqualTo(Time $time)
    {
        return
            $this->getHours()->isEqualTo($time->getHours()) &&
            $this->getMinutes()->isEqualTo($time->getMinutes()) &&
            $this->getSeconds()->isEqualTo($time->getSeconds());
    }

    /**
     * @return Hours
     */
    public function getHours()
    {
        return clone $this->hours;
    }

    /**
     * @return Minutes
     */
    public function getMinutes()
    {
        return clone $this->minutes;
    }

    /**
     * @return Seconds
     */
    public function getSeconds()
    {
        return clone $this->seconds;
    }

    /**
     * @param Time $time
     *
     * @return bool
     */
    public function isLaterThan(Time $time)
    {
        if ($this->getHours()->isLaterThan($time->getHours()) === true) {
            return true;
        } elseif ($time->getHours()->isLaterThan($this->getHours()) === true) {
            return false;
        }

        // hours is the same, lets check for minutes
        if ($this->getMinutes()->isLaterThan($time->getMinutes()) === true) {
            return true;
        } elseif ($time->getMinutes()->isLaterThan($this->getMinutes()) === true) {
            return false;
        }

        // hours and minutes are the same, lets check the seconds
        if ($this->getSeconds()->isLaterThan($time->getSeconds()) === true) {
            return true;
        } elseif ($time->getSeconds()->isLaterThan($this->getSeconds()) === true) {
            return false;
        }

        // times are equal
        return false;
    }

    /**
     * @param Time $time
     *
     * @return bool
     */
    public function isEqualToOrLaterThan(Time $time)
    {
        if ($this->isEqualTo($time) === true) {
            return true;
        }

        return $this->isLaterThan($time);
    }

    /**
     * @param Time $time
     *
     * @return bool
     */
    public function isEarlierThan(Time $time)
    {
        if ($this->getHours()->isEarlierThan($time->getHours()) === true) {
            return true;
        } elseif ($time->getHours()->isEarlierThan($this->getHours()) === true) {
            return false;
        }

        // hours is the same, lets check for minutes
        if ($this->getMinutes()->isEarlierThan($time->getMinutes()) === true) {
            return true;
        } elseif ($time->getMinutes()->isEarlierThan($this->getMinutes()) === true) {
            return false;
        }

        // hours and minutes are the same, lets check the seconds
        if ($this->getSeconds()->isEarlierThan($time->getSeconds()) === true) {
            return true;
        } elseif ($time->getSeconds()->isEarlierThan($this->getSeconds()) === true) {
            return false;
        }

        // times are equal
        return false;
    }

    /**
     * @param Time $time
     *
     * @return bool
     */
    public function isEqualToOrEarlierThan(Time $time)
    {
        if ($this->isEqualTo($time) === true) {
            return true;
        }

        return $this->isLaterThan($time);
    }

    /**
     * @param \DateTime $dateTime
     *
     * @return static
     */
    public static function fromDateTime(\DateTime $dateTime)
    {
        return static::fromValues((int)$dateTime->format('H'), (int)$dateTime->format('i'), (int)$dateTime->format('s'));
    }

    /**
     * @param $hours
     * @param $minutes
     * @param $seconds
     *
     * @return static
     */
    public static function fromValues($hours, $minutes, $seconds)
    {
        return new static(new Hours($hours), new Minutes($minutes), new Seconds($seconds));
    }

    /**
     * @return Time
     */
    public static function now()
    {
        return static::fromDateTime(new \DateTime('now'));
    }

    /**
     * @return array
     */
    public function getValue()
    {
        return array($this->hours->getValue(), $this->minutes->getValue(), $this->seconds->getValue());
    }
}
