<?php
/**
 * Created by PhpStorm.
 * User: mantas
 * Date: 18.12.4
 * Time: 12.39
 */

namespace App\Services;

class NumberFormatter
{
    /**
     * @var $number
     */
    private $number;

    /**
     * @return string
     */
    private function formatMillions(): string
    {
        return number_format($this->number / 1000000, 2) . 'M';
    }

    /**
     * @return string
     */
    private function formatHundredsThousands(): string
    {
        return number_format($this->number / 1000) . 'K';
    }

    /**
     * @return string
     */
    private function formatThousands(): string
    {
        return number_format($this->number, 0, '.', ' ');
    }

    /**
     * @return string
     */
    private function formatDefault(): string
    {
        return floor($this->number) === $this->number ? round($this->number) : number_format($this->number, 2);
    }

    /**
     * @param float $number
     * @return string
     */
    public function format(float $number): string
    {
        $this->number = $number;

        switch (true) {
            case abs($number) >= 999500:
                return $this->formatMillions();
            case abs($number) >= 99950:
                return $this->formatHundredsThousands();
            case abs($number) >= 999.9999:
                return $this->formatThousands();
            default:
                return $this->formatDefault();
        }
    }
}
