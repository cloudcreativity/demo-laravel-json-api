<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    public $timestamps = false;

    public $incrementing = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
    ];

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'token_type',
        'expires_in',
    ];

    protected $visible = [
        'token_type',
        'expires_in',
    ];
}
