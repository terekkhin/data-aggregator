<?php

namespace App\Actions;

use App\Models\VkDataAgg;
use Carbon\Carbon;

class GetDailyReportAction
{
    public static function handle(){
        $yesterday = Carbon::yesterday();
        $yesterdayString = $yesterday->toDateString();
        return VkDataAgg::where('date', $yesterdayString)->get();
    }
}