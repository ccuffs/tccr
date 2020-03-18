<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Activities related to the life-cycle of a Project.
 */
class Log extends Model
{
    const CREATED          = 1;
    const DELETED          = 2;
    const ATTRIBUTE_CHANGE = 3;
    const MEMBER_ADD       = 4;
    const MEMBER_REMOVE    = 5;
    const GRADE            = 6;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'type' => Log::ATTRIBUTE_CHANGE,
    ];
}
