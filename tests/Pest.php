<?php


use App\Models\VkDataAgg;
use Carbon\Carbon;
use Pest\Exceptions;
use Illuminate\Support\Facades\Http;

uses(Tests\TestCase::class);

it('checks if daily_report is correct', function(){
    $response = $this->get('api/daily_report/');

    $yesterday = Carbon::yesterday();
    $yesterdayString = $yesterday->toDateString();

    $response->assertOk();
    $response->assertJsonCount(VkDataAgg::where('date', $yesterdayString)->distinct('group_id')->count());
    foreach (json_decode($response->content()) as $item) {
        expect($item)->toHaveKeys(['group_name', 'group_id'])
            ->and($item->group_name)->toBeString()
            ->and($item->group_id)->toBeNumeric()
            ->and($item->date)->toBeString()
            ->and($item->cnt_posts)->toBeNumeric()
            ->and($item->cnt_likes)->toBeNumeric()
            ->and($item->cnt_comments)->toBeNumeric()
            ->and($item->cnt_reposts)->toBeNumeric();
    }
});

it('checks if vk-api-connector is accessible', function (){
    $response = Http::get(config('url_config.VK_API_CONNECTOR_URL'));
    expect($response->status())->toBe(200);
});
