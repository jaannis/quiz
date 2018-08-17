<?php

namespace Quiz\Tests;

use PHPUnit\Framework\TestCase;
use Quiz\BowlingCalculator;

class bowlingTest extends TestCase
{
    /**
     * @var BowlingCalculator
     */
    private $calculator;

    /**
     *
     */
    public function setUp()
    {
        $this->calculator = new BowlingCalculator();

        parent::setUp();
    }

    public function test_withNoHits_returnsScore0()
    {
        for ($i = 0; $i < 20; $i++) {
            $this->calculator->throw(0);
        }
        $score = $this->calculator->getScore();

        $this->assertEquals(0, $score);
    }

    public function test_withSimpleThrows_calculateScore()
    {
        for ($i = 0; $i < 20; $i++) {
            $this->calculator->throw(1);
        }
        $score = $this->calculator->getScore();
        $this->assertEquals(20, $score);
    }

    public function test_withASpare_shouldAddMorePoints()
    {
        $this->calculator->throw(5);
        $this->calculator->throw(5);
        $this->calculator->throw(3);

        for ($i = 0; $i < 17; $i++) {
            $this->calculator->throw(1);
        }
        $score = $this->calculator->getScore();
        $this->assertEquals(38, $score);
    }

//    public function test_withAStrike_shouldAddPointsOfNextTwoThrows()
//    {
//        $this->calculator->throw(10);
//        $this->calculator->throw(5);
//        $this->calculator->throw(1);
//
//        for ($i = 0; $i < 16; $i++) {
//            $this->calculator->throw(1);
//        }
//        $score = $this->calculator->getScore();
//        $this->assertEquals(38, $score);
//
//    }
}