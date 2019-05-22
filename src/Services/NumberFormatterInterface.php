<?php

namespace App\Services;

interface NumberFormatterInterface
{

    /**
     * @param float $number
     * @return string|null
     */
    public function formatNumber(float $number): string;
}
