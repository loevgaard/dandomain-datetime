<?php
namespace Loevgaard\DandomainDateTime;

use DateTimeZone;

/**
 * This class represents a date time in Dandomain where the time zone is always Europe/Copenhagen
 */
class DateTimeImmutable extends \DateTimeImmutable
{
    public function __construct($time = 'now')
    {
        if (strpos($time, '@') !== false) {
            throw new \InvalidArgumentException('Use DateTimeImmutable::createFromTimestamp instead');
        }

        parent::__construct($time, static::timeZone());
    }

    /**
     * @param \DateTimeInterface $dt
     *
     * @return static
     */
    public static function instance(\DateTimeInterface $dt)
    {
        if ($dt instanceof static) {
            return clone $dt;
        }

        return new static($dt->format('Y-m-d H:i:s.u'));
    }

    /**
     * @param string $format
     * @param string $time
     * @param \DateTimeZone $timezone
     * @return DateTimeImmutable
     */
    public static function createFromFormat($format, $time, $timezone = null)
    {
        if ($timezone !== null) {
            throw new \InvalidArgumentException('Do not pass time zone as an argument');
        }

        $dt = parent::createFromFormat($format, $time, static::timeZone());
        return static::instance($dt);
    }

    /**
     * @param \DateTime $dateTime
     * @return DateTimeImmutable
     */
    public static function createFromMutable($dateTime) : DateTimeImmutable
    {
        $dt = static::createFromMutable($dateTime);
        return $dt->setTimezone(static::timeZone());
    }

    /**
     * @param int|string $timestamp
     * @return DateTimeImmutable
     */
    public static function createFromTimestamp($timestamp) : DateTimeImmutable
    {
        $dateTime = new \DateTime('@'.$timestamp);
        $dateTime->setTimezone(static::timeZone());
        return static::instance($dateTime);
    }

    public static function createFromJson(string $json) : DateTimeImmutable
    {
        preg_match('/([0-9]+)\+/', $json, $matches);
        if (!isset($matches[1])) {
            throw new \InvalidArgumentException('$json is not a valid JSON date. Input: ' . $json);
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
