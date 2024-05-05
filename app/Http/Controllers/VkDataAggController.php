<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\GetVkDataAction;
use App\Actions\GetDailyReportAction;
use App\Models\VkDataAgg;
use Carbon\Carbon;

class VkDataAggController extends Controller
{
    public function index() {
        return 'Hello, from data-aggregator!';
    }

//    public static function test_create() {
//        VkDataAgg::create([
//            'group_name' => 'test1',
//            'group_id' => 'test',
//            'date' => '2024-04-07',
//            'cnt_posts' => 10,
//            'cnt_likes' => 10,
//            'cnt_comments' => 10,
//            'cnt_reposts' => 10,
//        ]);
//    }

    public static function get_vk_data() {
        GetVkDataAction::handle();
    }

    public function daily_report() {
        $data = GetDailyReportAction::handle();
        return response()->json($data, 200);
    }
}
