<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VkDataAgg extends Model
{
    use HasFactory;
    protected $table = 'vk_data_aggs';
    protected $guarded = [];
}
