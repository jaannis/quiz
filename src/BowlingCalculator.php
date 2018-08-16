<?php

namespace Quiz;

class BowlingCalculator
{
    private $throws = [];

    public function throw(int $hits)
    {
        $this->throws[] = $hits;
    }

    public function getScore(): int
    {
        $score        = 0;
        $currentThrow = 0;
        for ($i = 0; $i < 10; $i++) {
            if ($this->isStrike($currentThrow)) {
                $score        += $this->addStrike($currentThrow);
                $currentThrow += 1;
            } elseif ($this->isSpare($currentThrow)) {
                $score += $this->addSpare($currentThrow);
            } else {
                $score += $this->addNormal($currentThrow);
            }
            $currentThrow += 2;

        }

        return $score;

    }

    /**
     * @param $currentThrow
     * @return bool
     */
    private function isSpare($currentThrow): bool
    {
        return $this->addNormal($currentThrow) == 10;
    }

    /**
     * @param $currentThrow
     * @return mixed
     */
    private function addSpare($currentThrow): int
    {
        return $this->addNormal($currentThrow) + $this->throws[$currentThrow + 1] + $this->throws[$currentThrow + 2];
    }

    /**
     * @param $currentThrow
     * @return mixed
     */
    private function addNormal($currentThrow): int
    {
        return $this->throws[$currentThrow] + $this->throws[$currentThrow + 1];
    }

    private function isStrike(int $currentThrow): bool
    {
        return $this->throws[$currentThrow] == 10;
    }

    private function addStrike(int $currentThrow)
    {
        return 10 + $this->throws[$currentThrow + 1] + $this->throws[$currentThrow + 2];
    }

}