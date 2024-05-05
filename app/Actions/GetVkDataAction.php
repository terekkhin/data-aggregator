<?php

namespace App\Actions;

use App\Models\VkDataAgg;

class GetVkDataAction
{
    public static function handle()
    {
        $last_update = VkDataAgg::get('updated_at')->max()->updated_at;
        $data = json_decode(file_get_contents(config('url_config.VK_API_CONNECTOR_URL') . '/api/grouped_data?start_date=' . urlencode($last_update)));

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
    }
}