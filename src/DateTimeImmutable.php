<?php
namespace Loevgaard\DandomainDateTime;

use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use InvalidArgumentException;

/**
 * This class represents a date time in Dandomain where the time zone is always Europe/Copenhagen
 */
class DateTimeImmutable extends \DateTimeImmutable
{
    public function __construct($time = 'now')
    {
        if (strpos($time, '@') !== false) {
            throw new InvalidArgumentException('Use DateTimeImmutable::createFromTimestamp instead');
        }

        parent::__construct($time, static::timeZone());
    }

    /**
     * @throws Exception
     */
    public static function instance(DateTimeInterface $dt) : DateTimeImmutable
    {
        if ($dt instanceof static) {
            return clone $dt;
        }

        return new static($dt->format('Y-m-d H:i:s.u'));
    }

    /**
     * @throws Exception
     */
    public static function createFromFormat($format, $time, $timezone = null) : DateTimeImmutable
    {
        if ($timezone !== null) {
            throw new InvalidArgumentException('Do not pass time zone as an argument');
        }

        $dt = parent::createFromFormat($format, $time, static::timeZone());
        return static::instance($dt);
    }

    /**
     * @param DateTime $dateTime
     * @return DateTimeImmutable
     */
    public static function createFromMutable($dateTime) : DateTimeImmutable
    {
        $dt = static::createFromMutable($dateTime);
        return $dt->setTimezone(static::timeZone());
    }

    /**
     * @throws Exception
     */
    public static function createFromTimestamp($timestamp) : DateTimeImmutable
    {
        if (is_string($timestamp) && ($pos = strpos($timestamp, '.')) !== false) {
            $timestamp = substr($timestamp, 0, $pos);
        }

        $dateTime = new DateTime('@'.$timestamp);
        $dateTime->setTimezone(static::timeZone());
        return static::instance($dateTime);
    }

    /**
     * @throws Exception
     */
    public static function createFromJson(string $json) : DateTimeImmutable
    {
        preg_match('/(\d+)\+/', $json, $matches);
        if (!isset($matches[1])) {
            throw new InvalidArgumentException('$json is not a valid JSON date. Input: ' . $json);
        }

        // remove the last three digits since the json date is given in milliseconds
        $timestamp = substr($matches[1], 0, -3);

        return static::createFromTimestamp($timestamp);
    }

    /**
     * Returns the default Dandomain time zone
     *
     * @return DateTimeZone
     */
    protected static function timeZone() : DateTimeZone
    {
        return new DateTimeZone('Europe/Copenhagen');
    }
}
