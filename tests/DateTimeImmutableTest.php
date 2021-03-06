<?php

namespace Loevgaard\DandomainDateTime;

use PHPUnit\Framework\TestCase;

class DateTimeImmutableTest extends TestCase
{
    public function testDefaultInstantiation()
    {
        new DateTimeImmutable();
        $this->assertTrue(true);
    }

    public function testTimestampExceptionOnInstantiation()
    {
        $this->expectException(\InvalidArgumentException::class);
        new DateTimeImmutable('@1414141141414');
    }
}
