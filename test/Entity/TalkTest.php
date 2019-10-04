<?php

use PHPUnit\Framework\TestCase;
use Solcre\ptptalks\Entity\Talk;
use Solcre\ptptalks\Exception\InvalidFilenameException;

class TalkTest extends TestCase
{
    public function testGetId()
    {
        $talk = new Talk('20190101.json', 'Drunk guy', 'New year dinner jokes', [ "jokes", "dinner", "new year" ]);
        $this->assertEquals(20190101, $talk->getId());
    }
    public function testGetIdInWrongFile()
    {
        $talk = new Talk('wrongtalk.json', 'Drunk guy', 'New year dinner jokes', [ "jokes", "dinner", "new year" ]);
        $this->expectException(InvalidFilenameException::class);
        $this->assertEquals(20190101, $talk->getId());
    }
}