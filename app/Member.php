<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    const AUTHOR     = 1; 
    const ADVISOR    = 2; 
    const COADVISOR  = 3; 
    const EXAMINER   = 4;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'role' => Member::AUTHOR,
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
