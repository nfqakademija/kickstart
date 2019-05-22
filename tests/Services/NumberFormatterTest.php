<?php

namespace App\Tests\Services;
use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            ['2.84M', 2840000],
            ['2.00M', 1995799],
            ['1.58M' , 1580000],
            ['36.56M', 36560001],
            ['19.00M', 19000001],
            ['800K', 799999],
            ['315K', 314999],
            ['879K', 878999],
            ['123K', 123111],
            ['80 999', 80999],
            ['545', 545.00],
            ['518', 518.00],
            ['53', 53.00],
            ['-99.80M', -99799999],
            ['-2.84M', -2836789],
            ['-234K', -233999],
            ['-518', -518],
            ['-53', -53.00],
            ['-345.00M', -344999999],
            ['-211K', -210999],
            ['-14 000', -14000],
            ['-42.42', -42.42111111],
            ['-315K', -314899 ],
            ['0', 0]
        ];
    }


    /**
     * @dataProvider dataProvider
     * @param $expectedResult
     * @param $givenNumber
     */
    public function testFormat($expectedResult, $givenNumber)
    {
        $numberFormatter = new NumberFormatter();
        $this->assertEquals($expectedResult, $numberFormatter->formatNumber($givenNumber));
    }
}
