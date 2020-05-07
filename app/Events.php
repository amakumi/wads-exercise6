<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'eventOrganizer',
        'eventName',
        'startDate',
        'endDate',
        'eventDescription',
        'email',
        'phone'
    ];
}