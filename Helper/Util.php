<?php

namespace App\Helper;

use DateTime;
use Illuminate\Support\Str;

class Util
{
    protected static $instance  = null;

    public static function getInstance(): ?Util
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getToken($string = ''): string
    {
        return  hash('sha256', $string ?: Str::random(60));
    }

    public function getDatesByPeriodName($period, $currentDate)
    {
        $dates = ["", ""];
        if ($period == 'today') {
            $dates = [$currentDate->format('Y-m-d'), $currentDate->format('Y-m-d')];
        } elseif ($period == 'this_week') {

            $startDate = date('Y-m-d', strtotime('Monday this week'));
            $endDate = date('Y-m-d', strtotime('Sunday this week'));
            $dates = [$startDate, $endDate];
        } elseif ($period == 'last_month') {
            $year = date('Y');
            $month = $currentDate->subMonths(1)->format('M');

            $endOfMonth = new DateTime("last day of $month $year");
            $endDate = $endOfMonth->format('Y-m-d');

            $startOfMonth = new DateTime("first day of $month $year");
            $startDate = $startOfMonth->format('Y-m-d');

            $dates = [$startDate, $endDate];
        } elseif ($period == 'this_month') {
            $year = date('Y');
            $month = $currentDate->format('M');

            $startOfMonth = new DateTime("first day of $month $year");
            $startDate = $startOfMonth->format('Y-m-d');

            $endOfMonth = new DateTime("last day of $month $year");
            $endDate = $endOfMonth->format('Y-m-d');

            $dates = [$startDate, $endDate];
        } elseif ($period == 'last_30_days') {
            $endDate = $currentDate->format('Y-m-d');
            $startDate = $currentDate->subDays(30)->format('Y-m-d');
            $dates = [$startDate, $endDate];
        } elseif ($period == 'this_year') {
            $year = date('Y');
            $endOfYear = new DateTime("last day of December $year");
            $endDate = $endOfYear->format('Y-m-d');

            $startOfYear = new DateTime("first day of January $year");
            $startDate = $startOfYear->format('Y-m-d');

            $dates = [$startDate, $endDate];
        } elseif ($period == 'last_year') {
            $year = $currentDate->subYears(1)->format('Y');
            $endOfYear = new DateTime("last day of December $year");
            $endDate = $endOfYear->format('Y-m-d');

            $startOfYear = new DateTime("first day of January $year");
            $startDate = $startOfYear->format('Y-m-d');

            $dates = [$startDate, $endDate];
        }
        return $dates;
    }



    

    //     public function generateSalesOrderNo($saleOrderHead, $saleOrderNo)
    //     {
    //         $salesOrderAutoNumber = new ClientAutoNumber();

    //         // Assign default sales order head and no, if it's null
    //         if ($saleOrderNo == null && $saleOrderHead == null) {
    //             $saleOrderHead = ClientAutoNumber::SALES_ORDER_HEAD;
    //             $saleOrderNo = ClientAutoNumber::SALES_ORDER_DIGIT;

    //             $salesOrderAutoNumber->salesOrderHead = $saleOrderHead;
    //             $salesOrderAutoNumber->salesOrderNo = str_pad(1, strlen($saleOrderNo), '0', STR_PAD_LEFT);
    //         }

    //         $maxValue = str_replace(ClientAutoNumber::INITIAL_SALE_ORDER_NO, ClientAutoNumber::MAX_VALUE, $saleOrderNo);

    //         // Increase number of digits if it exceed maximum value
    //         if ($saleOrderNo == $maxValue) {
    //             $numberOfDigits = strlen($saleOrderNo) + 1;

    //             $salesOrderAutoNumber->salesOrderHead = $saleOrderHead;
    //             $salesOrderAutoNumber->salesOrderNo = str_pad(1, $numberOfDigits, '0', STR_PAD_LEFT);
    //         } else {
    //             $nextSalesOrderNo = intval($saleOrderNo) + 1;
    //             $numberOfDigits = strlen($saleOrderNo);
    //             $salesOrderAutoNumber->salesOrderHead = $saleOrderHead;
    //             $salesOrderAutoNumber->salesOrderNo = str_pad($nextSalesOrderNo, $numberOfDigits, '0', STR_PAD_LEFT);
    //         }
    //         return $salesOrderAutoNumber;
    //     }
}
