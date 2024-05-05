<?php

namespace App\Http\Controllers;

use App\Actions\GetVkDataAction;
use App\Actions\GetDailyReportAction;


class VkDataAggController extends Controller
{
    public function index() {
        return 'Hello, from data-aggregator!';
    }

    public static function get_vk_data() {
        GetVkDataAction::handle();
    }

    public function daily_report() {
        $data = GetDailyReportAction::handle();
        return response()->json($data, 200);
    }
}
