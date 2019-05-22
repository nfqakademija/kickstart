<?php

namespace App\Services;

class NumberFormatter implements NumberFormatterInterface
{
    /**
     * @param float $number
     * @return string
     */
    public function formatNumber(float $number): string
    {
        $result = null;
        $negativeNumber = false;

//        Check if negative
        if ($number < 0) {
            $number = $number * -1;
            $negativeNumber = true;
        }

        $roundedNumber = round($number, 2);

        $result = $this->formatNumberByIntervals($roundedNumber);

        return $negativeNumber ? '-' . $result : $result;
    }


    /**
     * @param $roundedNumber
     * @return int|string
     */
    public function formatNumberByIntervals(float $roundedNumber)
    {
        //Nezinau kodel bet 0 visada ikrenta i pirma switcha case'a
        if ($roundedNumber == 0) {
            return 0;
        }

        switch ($roundedNumber) {
            case ($roundedNumber >= 999500):
                return number_format($roundedNumber / 1000000, 2, '.', ' ') . 'M';
                break;
            case ($roundedNumber >= 99950):
                return number_format($roundedNumber / 1000) . 'K';
                break;
            case ($roundedNumber >= 1000):
                return number_format($roundedNumber, 0, '', ' ');
                break;
            default:
                return (floor($roundedNumber) == $roundedNumber) ? number_format($roundedNumber) : number_format($roundedNumber,
                    2, '.', ' ');
        }
    }
}
