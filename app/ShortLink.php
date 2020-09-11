<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    //
    protected $fillable = [
        'title','user_id', 'org_url', 'short_url','slug',
    ];
}
