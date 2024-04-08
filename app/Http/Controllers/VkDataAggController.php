<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $last_update = VkDataAgg::get('updated_at')->max()->updated_at;
        $data = json_decode(file_get_contents('https://69dc-93-188-41-68.ngrok-free.app/api/grouped_data?start_date=' . urlencode($last_update)));

        foreach($data as $group_stat){
            $curr_group_stat = VkDataAgg::where('date', today()->toDateString())->where('group_id', $group_stat->group_id)->get();
            if ($curr_group_stat->count() > 0) {
                $curr_group_stat->update([
                    'cnt_likes' => $curr_group_stat->cnt_likes + $group_stat->cnt_likes,
                    'cnt_comments' => $curr_group_stat->cnt_comments + $group_stat->cnt_comments,
                    'cnt_reposts' => $curr_group_stat->cnt_reposts + $group_stat->cnt_reposts,
                    'cnt_posts' => $curr_group_stat->cnt_posts + $group_stat->cnt_posts,
                ]);
            } else {
                VkDataAgg::create([
                    'group_name' => $group_stat->group_name,
                    'group_id' => $group_stat->group_id,
                    'date' => today()->toDateString(),
                    'cnt_likes' => $group_stat->cnt_likes,
                    'cnt_comments' => $group_stat->cnt_comments,
                    'cnt_reposts' => $group_stat->cnt_reposts,
                    'cnt_posts' => $group_stat->cnt_posts,
                ]);
            }
        }

        return $data;
    }

    public function daily_report() {
        $yesterday = Carbon::yesterday();
        $yesterdayString = $yesterday->toDateString();
        $data = VkDataAgg::where('date', $yesterdayString)->get();
        return response()->json($data, 200);
    }
}
