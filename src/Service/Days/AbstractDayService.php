<?php

namespace App\Service\Days;

abstract class AbstractDayService
{
    public function generate(array $rows, int $part): string
    {
        if ($part === 1) {
            return $this->generatePart1($rows);
        }

        return $this->generatePart2($rows);
    }
}
