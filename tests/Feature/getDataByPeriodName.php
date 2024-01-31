<?php

namespace Tests\Feature;


use App\Helper\Util;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\TestCase;

class getDataByPeriodName extends TestCase
{
    public function testTodayByPeriodName()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $dates = Util::getInstance()->getDatesByPeriodName('today', $currentDate);
        $this->assertEquals('2024-01-13', $dates[0]);
        $this->assertEquals('2024-01-18', $dates[1]);
    }

    public function testThisWeekByPeriodName()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $dates = Util::getInstance()->getDatesByPeriodName('this_week', $currentDate);
        $this->assertEquals('2024-01-16', $dates[0]);
        $this->assertEquals('2024-01-22', $dates[1]);
    }

    public function testLast30DaysByPeriodName()
    {
        $currentDate = Carbon::parse('2023-06-16');
        $dates = Util::getInstance()->getDatesByPeriodName('last_30_days', $currentDate);
        $this->assertEquals('2023-05-17', $dates[0]);
        $this->assertEquals('2023-06-16', $dates[1]);
    }

    public function testThisMonthByPeriodName()
    {
        $currentDate = Carbon::parse('2024-01-18');
        $dates = Util::getInstance()->getDatesByPeriodName('this_month', $currentDate);
        $this->assertEquals('2024-01-01', $dates[0]);
        $this->assertEquals('2024-01-30', $dates[1]);
    }

    public function testLastMonthByPeriodName()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $dates = Util::getInstance()->getDatesByPeriodName('last_month', $currentDate);
        $this->assertEquals('2023-12-01', $dates[0]);
        $this->assertEquals('2023-12-31', $dates[1]);
    }

    public function testLastYearByPeriodName()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $dates = Util::getInstance()->getDatesByPeriodName('last_year', $currentDate);
        $this->assertEquals('2023-01-01', $dates[0]);
        $this->assertEquals('2023-12-31', $dates[1]);
    }

    public function testThisYearByPeriodName()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $dates = Util::getInstance()->getDatesByPeriodName('this_year', $currentDate);
        $this->assertEquals('2024-01-01', $dates[0]);
        $this->assertEquals('2024-12-31', $dates[1]);
    }
}
