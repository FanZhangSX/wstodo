<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'name', 'description', 'except_finish_time', 'is_completed', 'finish_time'
    ];

}
