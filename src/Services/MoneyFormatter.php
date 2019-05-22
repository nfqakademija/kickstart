<?php

namespace App\Services;

class MoneyFormatter
{


    /**
     * @var App\Services\NumberFormatterIntercafe
     */
    private $numberFormatter;


    public function __construct(NumberFormatterInterface $numberFormatter)
    {
        $this->numberFormatter = $numberFormatter;
    }


    /**
     * @param $number
     * @return string
     */
    public function formatEur($number): string
    {
        $result = $this->numberFormatter->formatNumber($number);

        return $result . '€';
    }

    /**
     * @param $number
     * @return string
     */
    public function formatUsd($number): string
    {
        $result = $this->numberFormatter->formatNumber($number);

        return '$' . $result;
    }
}
