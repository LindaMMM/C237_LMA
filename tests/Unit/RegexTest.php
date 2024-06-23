<?php

namespace App\Test\Unit;

use PHPUnit\Framework\TestCase;

final class RegexTest extends TestCase
{
    public function testRegexPhone(): void
    {
        $element = "+33600031234";
        $this->assertMatchesRegularExpression('/^(0|(\+)33)([1-7]{1})[0-9]{8}/', $element);
    }
    public function testRegexAddress(): void
    {
        $element = "18 bis rue des bourgniers 08800 CHOLET";
        $this->assertMatchesRegularExpression('/^(\d{1,4})\s?(bis|ter(?=))?\s(rue|avenue|boulevard|allee|chemin)\s(([[:alpha:]]+\s){1,4})(\d{5})\s(([[:alpha:]]+){1,4})/', $element);
        $this->assertMatchesRegularExpression('/^(\d{1,4})\s?(bis|ter(?=))?\s(rue|avenue|boulevard|allee|chemin)/', $element);
    }
    public function testGreetsWithName(): void
    {
        $element = "find this text";
        $test = preg_match('/find this text/i', $element);

        if ($test) {
            echo 'text found';
        } else {
            echo 'text not found';
        }
        $this->assertNotFalse($test);
    }
}
