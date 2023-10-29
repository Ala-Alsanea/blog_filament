<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TagPost extends Pivot
{
    //

    protected $fillable = [
        'post_id',
        'tag_id',

    ];

    protected $table = 'tag_post';
}
